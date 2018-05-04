<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompUserEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $pass)
    {
        //
        $this->user = $user;
        $this->pass = $pass;
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
            'pass' => $this->pass,
        ];
        return $this->view('emails.CompUserEmail')->with('data', $data)
            ->subject('Company Registration Complete.');
    }
}
