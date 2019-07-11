<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPaid;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTransaction
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
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {

        //this line of code is just an example should be implemented in a dynamic way for every payments this would create a transaction in the transaction table which is related to the orders table
        $event->order->transaction()->create([
            'total' => $event->order->total()->amount()
        ]);
    }
}
