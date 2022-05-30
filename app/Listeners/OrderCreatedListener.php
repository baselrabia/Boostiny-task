<?php

namespace App\Listeners;

use App\Notifications\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class OrderCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;
        Log::info("order created", [$order->product->seller]);

        $order->product->seller->notify(new OrderCreated($order));
        // Notification::route('mail', $order->product->seller->email)
        // ->route('sms', $order->product->seller->phone)
        // ->notify(new OrderCreated($order));

    }
}
