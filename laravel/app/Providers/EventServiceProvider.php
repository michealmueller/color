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
        'App\Events\NewUser' => [
            'App\Listeners\NewUserListener',
            'App\Listeners\NewUserAdminMsg',
        ],
        'App\Events\PaymentReceipt' => [
            'App\Listeners\PaymentRecieptListener',
        ],
        'App\Events\EventPaymentReceipt' => [
            'App\Listeners\EventPaymentRecieptListener',
        ],
        'App\Events\CompUser' => [
            'App\Listeners\CompUserListener',
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
