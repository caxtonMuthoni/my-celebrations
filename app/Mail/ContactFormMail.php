<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $message)
    {
        $this->msg = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mycelebrationbooks.com form submission')->view('emails.contact-form-mail');
    }
}
