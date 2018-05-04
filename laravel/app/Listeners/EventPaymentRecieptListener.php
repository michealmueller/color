<?php

namespace App\Listeners;

use App\Events\EventPaymentReceipt;
use App\Mail\EventPaymentRecieptMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EventPaymentRecieptListener
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
     * @param  EventPaymentReceipt  $event
     * @return void
     */
    public function handle(EventPaymentReceipt $event)
    {
        //
        Mail::to($event->user)->send(new EventPaymentRecieptMail($event->user, $event->amount, $event->event));
    }
}
