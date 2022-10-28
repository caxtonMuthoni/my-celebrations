<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\BookMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageDeleteUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public Book $book;
    public BookMessage $bookMessage;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($book, $bookMessage, $link)
    {
        $this->book = $book;
        $this->bookMessage = $bookMessage;
        $this->link = $link;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Message Update and Delete OTP',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.book_message_update_edit',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
