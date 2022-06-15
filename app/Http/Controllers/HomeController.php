<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Auth::user()->books()->count();
        $published = Auth::user()->books()->where('published', true)->count();
        $draft = Auth::user()->books()->where('published', '!=', true)->count();
        $latestBooks = Auth::user()->books()->latest()->take(4)->get();
        $data = [
            'books' => $books,
            'published' => $published,
            'draft' => $draft,
            'messages' => 0,
            'latest_books' => $latestBooks
        ];

        return view('home', compact('data'));
    }

    // Home

    public function home()
    {
        $books = Book::with('user')->where('public', true)->latest()->take(4)->get();
        return view('home.welcome', compact('books'));
    }

    public function aboutUs()
    {
        return view('home.about');
    }

    public function faqs()
    {
        $faqs = [
            [
                'question' => ' Can I create an account on someone’s behalf and how do I transfer it to them? ',
                'answer' => ' Yes, you can create for someone else and use the account transfer feature to change account ownership.'
            ],
            [
                'question' => 'Can there be more than one book for the same event? ',
                'answer' => 'Yes, different people can create a book for the same event.',
            ],
            [
                'question' => 'Who can edit the book? ',
                'answer' => 'Only the account holder has the rights to edit the book.'
            ],
            [
                'question' => 'Is the book accessible globally? ',
                'answer' => 'Yes, the book can be seen as well as receive messages from anywhere around the globe.'
            ],
            [
                'question' => 'How long can my celebration books remain on my account? ',
                'answer' => 'The book, once created will remain in the system unless it is deleted by the account owner or the account is closed.'
            ],
            [
                'question' => 'Can one change appearance after the book has been generated? ',
                'answer' => 'Yes, the account owner can edit the book at any point.'
            ],
            [
                'question' => 'What does public or private book mean? ',
                'answer' => 'A private book can only be viewed by those who have received a link from the creator. Likewise, only those with the link can send messages or pictures to the account. A public book can be seen in the public books section and anyone can view and send messages.'
            ],
            [
                'question' => 'Can a deleted book be recovered?',
                'answer' => ' No. A book deleted by the account owner cannot be recovered.'
            ],
            [
                'question' => 'Can I correct or update my message after I have submitted? ',
                'answer' => 'Yes. The system send you a one-time password (OTP) which you can use to correct a message send to a book.'
            ],





        ];
        return view('home.faqs', compact('faqs'));
    }

    public function pricing()
    {
        $plans = SubscriptionPlan::with('features.featureDetails')->get();
        return view('home.pricing', compact('plans'));
    }
}
