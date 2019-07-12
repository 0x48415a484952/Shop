<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class DeletePendingOrdersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletependingorders:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //we can write our database logic here forexample the deleting the pending orders
        // dd('it is working fine');
        // $this->info('DeletePendingOrdersCron:Cron Cummand Run successfully!');
        Log::info("before going to the fucking model call");
        $orders = Order::all();
        foreach($orders as $order) {
            if($order->status == 'pending' || $order->status == 'payment_failed') {
                $orderCreatedTime = strtotime($order->created_at); 
                // $currentTime = strtotime(date('Y-m-d H:i:s'));
                $currentTime = time();
                if($currentTime - $orderCreatedTime >= 3600) {
                    $order->delete();
                }
            }
        }
        Log::info("Cron is working fine! And Deleted All Pending Orders");
        $this->info('Cronjob is working ok Hazhir');
    }
}
