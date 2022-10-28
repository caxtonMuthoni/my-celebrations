<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookImageDeleteUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public Book $book;
    public BookImage $bookImage;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($book, $bookImage, $link)
    {
        $this->book = $book;
        $this->bookImage = $bookImage;
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
            subject: 'Book Image Delete or Update OTP',
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
            view: 'emails.book_image_update_delete',
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
