<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Cart\Cart;
use App\Models\Order;
use App\Events\Order\OrderPaymentFailed;

class MarkOrderPaymentFailed implements ShouldQueue
{

    protected $gateway;
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
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        try {

            //not my way needs some more functionalities to be implemented in AppServiceProvicer!!! which i have not created
            // $this->gateway->withUser($order->user)
            //     ->getCustomer()
            //     ->charge(
            //         $order->paymentMethod, $order->total()->amount()
            //     );
            event(new OrderPaid($order));
        }
        // i have not created PaymentFailedException and should be created 
        catch(PaymentFailedException $e) {
            event(new OrderPaymentFailed($order));
        }
    }
}
