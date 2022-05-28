<?php

namespace App\Services;

use App\Factories\PaymentFactory;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**@var OrderRepository $orderRepo order repository instance */
    public $orderRepo;
    public $productRepo;
    public $payment;

    /**
     * __construct function
     *
     * @param OrderRepository $orderRepo
     */
    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo, PaymentFactory $payment)
    {
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
        $this->payment = $payment;
    }

    /**
     * List orders
     *
     *
     * @return collection
     */
    public function list()
    {

        return $this->orderRepo->list();
    }

    /**
     * Get order by id
     *
     * @param int $id
     * @return collection
     */
    public function get($id)
    {
        return $this->orderRepo->find($id);
    }


    //createOrder
    public function createOrder($data)
    {
        $product = $this->productRepo->find($data['product_id']);
        if($product->quantity < $data['quantity']){
          throw new \Exception('Product is not enough');
        }
        try{
            DB::beginTransaction();
            // lock for update
            $product->lockForUpdate([
                'quantity' => $product->quantity - $data['quantity']
            ]);

            $data['total'] = $product->price * $data['quantity'];

            $order = $this->orderRepo->create([
                'product_id' => $data['product_id'],
                'user_id' => auth()->user()->id,
                'quantity' => $data['quantity'],
                'total' => $data['total'],
            ]);

            $payment = $this->payment->make($data['payment_method']);
            $payment->createPayment($order);
            
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw new \Exception('Error creating order : ' . $e->getMessage());
        }

        return $order;

    }
}
