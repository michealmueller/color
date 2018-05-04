<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentReceiptEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;
    public $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $amount)
    {
        //
        $this->user = $user;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'user' => $this->user,
            'amount' => $this->amount,
        ];

        $address = 'ColorMarketingGroup@colormarketing.com';
        $subject = 'Reciept for your records';
        return $this->view('emails.paymentreciept')
            ->from($address)
            ->replyTo($address)
            ->subject($subject)
            ->with('data', $data);
    }
}
