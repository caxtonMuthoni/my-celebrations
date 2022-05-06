<?php

namespace App\Http\Controllers;

use App\Models\Book;
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

    public function home() {
        $books = Book::with('user')->where('public', true)->latest()->take(4)->get();
        return view('home.welcome', compact('books'));
    }

    public function aboutUs() {
        return view('home.about');
    }

    public function faqs() {
        return view('home.faqs');
    }

    public function pricing() {
        return view('home.pricing');
    }
}
