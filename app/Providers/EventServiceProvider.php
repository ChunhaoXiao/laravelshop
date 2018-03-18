<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        /*'App\Events\ProductCreate' => [
            'App\Listeners\UpdateProductinfo',
            'App\Listeners\UpdateAttribute',
            'App\Listeners\UpdateGallery' ,
        ],*/

        'App\Events\ProductUpdated' => [
            'App\Listeners\UpdateProductinfo',
            'App\Listeners\DeleteAttribute',
            'App\Listeners\UpdateAttribute',
            'App\Listeners\DeleteGallery',
            'App\Listeners\UpdateGallery' ,
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\MoveCarts' ,
        ],

        'App\Events\OrderUpdated' => [
            'App\Listeners\SetProductNumber',
        ],

        SocialiteWasCalled::class => [        
            \SocialiteProviders\Weixin\WeixinExtendSocialite::class,    
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
