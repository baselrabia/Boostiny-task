<?php

namespace App\Classes\Payment;

use App\Models\Order;
use App\Models\Payment;

class OnlinePayment implements IPayment
{
    public function createPayment(Order $order): Payment
    {
        return Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'online',
            'amount' => $order->total,
            'status' => 'done',
        ]);
    }
}
