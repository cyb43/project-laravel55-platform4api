<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
//        ],

        // 发出访问令牌
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'App\Listeners\AccessTokenCreatedListener',
        ],

        // 刷新访问令牌
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'App\Listeners\RefreshTokenCreatedListener',
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
