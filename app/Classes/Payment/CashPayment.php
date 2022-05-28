<?php

namespace App\Classes\Payment;

use App\Models\Order;
use App\Models\Payment;

class CashPayment implements IPayment
{
    public function createPayment(Order $order): Payment
    {
        return Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'cash',
            'amount' => $order->total,
            'status' => 'pending',
        ]);
    }
}
