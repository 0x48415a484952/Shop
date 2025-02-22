<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        'App\Events\Order\OrderCreated' => [
            // 'App\Listeners\Order\ProcessPayment',
            'App\Listeners\Order\EmptyCart',
        ],

        'App\Events\Order\OrderPaymentFailed' => [
            'App\Listeners\Order\MarkOrderPaymentFailed',
            //we can create an event to send an sms on payment failed
        ],

        'App\Events\Order\OrderPaid' => [
            //needs to setup ttansaction model migration and relation of orders and transaction whcih an order hasMany transaction
            'App\Listeners\Order\CreateTransaction',
            'App\Listeners\Order\MarkOrderProcessing',
            //we can create an event to send an sms on payment successfull
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
