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
            $orders = $this->query()->with('seller')->paginate(50);
            Cache::set('orders_' . $page, $orders);
        }

        return $orders;
    }

}
