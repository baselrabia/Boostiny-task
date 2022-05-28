<?php

namespace App\Factories;

use App\Classes\Payment\CashPayment;
use App\Classes\Payment\IPayment;
use App\Classes\Payment\OnlinePayment;

class PaymentFactory
{
    public function make(string $source): IPayment
    {
        switch ($source) {
            case 'cash':
                return new CashPayment;
            case 'online':
                return new OnlinePayment;
            default:
                throw new \RuntimeException('Unknown payment source');
        }
    }
}
