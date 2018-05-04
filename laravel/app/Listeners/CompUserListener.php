<?php

namespace App\Listeners;

use App\Events\CompUser;
use App\Mail\CompUserEmail;use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class CompUserListener
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
     * @param  CompUser  $event
     * @return void
     */
    public function handle(CompUser $event)
    {
        //
        Mail::to($event->user)->send(new CompUserEmail($event->user, $event->pass));
    }
}