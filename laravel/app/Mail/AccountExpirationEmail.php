<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\Types\Integer;

class AccountExpirationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $days;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $days)
    {
        //
        $this->user = $user;
        $this->days = $days;
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
            'days' => $this->days,
        ];

        return $this->view('emails.accountexpiration')->with('data', $data);

    }
}
