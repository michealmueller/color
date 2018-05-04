<?php

namespace App\Listeners;

use App\Events\PaymentReceipt;
use App\Mail\PaymentReceiptEmail;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

/**
 * Class AccountExpirationListener
 * @package App\Listeners
 */
class PaymentRecieptListener implements ShouldQueue
{
    /**
     * @var
     */
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(PaymentReceipt $event)
    {
        //
        Mail::to($event->user)->send(new PaymentReceiptEmail($event->user, $event->amount));
    }
}
