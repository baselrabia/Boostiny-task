<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Cache;

class OrderRepository extends BaseRepository
{
    /**
     * __constructor
     *
     * @param Order $orderModel
     */
    public function __construct(Order $orderModel)
    {
        parent::__construct($orderModel);
    }

    //ListUserOrders
    public function ListUserOrders()
    {
        $user_id = auth()->user()->id;
        // $cachedOrders = Cache::get('orders_user_' . $user_id);

        // if (isset($cachedOrders)) {
        //     echo "cache layer\n";
        //     $orders = $cachedOrders;
        // } else {
        //     $orders = $this->query()->with('product')
        //         ->where('user_id',$user_id)
        //         ->orderBy('created_at', 'desc')
        //         ->get();
        //     Cache::set('orders_user_' . $user_id, $orders);
        // }

        $orders = cache::remember('orders_user_' . $user_id, 60 * 60, function () use ($user_id) {
            return $this->query()->with('product')
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->get();
        });

        return $orders;
    }


    //list
    public function list()
    {
        $page = request()->page ?? 0;
        // $cachedOrders = Cache::forget('orders_' . $page);
        $cachedOrders = Cache::get('orders_' . $page);

        if (isset($cachedOrders)) {
            echo "cache layer\n";
            $orders = $cachedOrders;
        } else {
            $orders = $this->query()->with('product')->orderBy('created_at', 'desc')->get();
            Cache::set('orders_' . $page, $orders);
        }

        return $orders;
    }

}
