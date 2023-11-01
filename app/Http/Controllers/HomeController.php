<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\ContactFormReplyMail;
use App\Models\Book;
use App\Models\Category;
use App\Models\Faq;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userBooks = Book::withCount('bookMessages')->where('user_id', Auth::id())->get();
        $books = $userBooks->count();
        $published = Auth::user()->books()->where('published', true)->count();
        $draft = Auth::user()->books()->where('published', '!=', true)->count();
        $latestBooks = Auth::user()->books()->latest()->take(4)->get();
        $userMessages = 0;
        foreach ($userBooks as $book) {
            $userMessages += $book->book_messages_count;
        }
        $data = [
            'books' => $books,
            'published' => $published,
            'draft' => $draft,
            'messages' => $userMessages,
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
        $faqs = Faq::latest()->get();
        return view('home.faqs', compact('faqs'));
    }

    public function pricing()
    {
        $plans = SubscriptionPlan::with('features.featureDetails')->get();
        return view('home.pricing', compact('plans'));
    }

    public function categories()
    {
        $categories = Category::latest()->get();
        return view('home.categories', compact('categories'));
    }

    public function contactUs(Request $request)
    {
        $this->validate($request, [
            'captcha' => 'required | captcha'
        ], [
            'captcha.captcha' => 'You entered invalid captcha.'
        ]);
        $message = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'reason' => $request->reason,
            'message' => $request->message,
        ];

        Mail::to('githinjicaxton323@gmail.com')->send(new ContactFormMail($message));
        Mail::to($request->email)->send(new ContactFormReplyMail($request->name));
        return redirect()->back()->with('success', 'Message was sent successfully');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
