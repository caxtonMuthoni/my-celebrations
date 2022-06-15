<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookTransferMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Book $book;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Book $book, User $user, $token)
    {
        $this->book =  $book;
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->book->title. 'book transfer')
        ->from('info@ngothotech.com', "MyCelebrationBooks Team")
        ->view('emails.accept_book_transfer');
    }
}
