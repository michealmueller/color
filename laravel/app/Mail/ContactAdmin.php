<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $location;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($location)
    {
        //
        $this->location = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.academicupload')
            ->with('location', $this->location)
            ->subject('Academic Authorization Request');
    }
}
