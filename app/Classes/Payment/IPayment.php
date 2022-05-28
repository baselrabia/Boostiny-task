<?php

namespace App\Classes\Payment;

use App\Models\Order;
use App\Models\Payment;

interface IPayment
{
    public function createPayment(Order $order): Payment;
}
