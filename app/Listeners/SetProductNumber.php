<?php

namespace App\Listeners;

use App\Events\OrderUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetProductNumber
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
     * @param  OrderUpdated  $event
     * @return void
     */
    public function handle(OrderUpdated $event)
    {
        $action = $event->OrderInfo->order_status ;
        if(method_exists($this, $action))
        {
            $this->$action($event->OrderInfo);
        }
    }

    function paied($order)
    {
        $products = $order->orderproducts()->with('product')->get();
        foreach($products as $product)
        {
            $product->product->number-=$product->number ;
            $product->product->save();
        }
    }

    function refund($order)
    {
        //退款
    }
}
