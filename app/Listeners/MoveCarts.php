<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Service\CartService;

class MoveCarts
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $cart ;
    public function __construct(CartService $cart)
    {
        $this->cart = $cart ;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */

    //用户登录时把存在 cookie 购物车里面的内容移到数据库
    public function handle(Login $event)
    {
        $carts = $this->cart->getCookieCarts();
        if($carts)
        {
            foreach($carts as $key => $cart)
            {
                $this->cart->cartToData($cart);
            }
        }
    }
}
