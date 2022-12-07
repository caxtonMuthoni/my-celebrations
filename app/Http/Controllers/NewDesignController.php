<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Faq;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class NewDesignController extends Controller
{
    public function welcome() {
        $books = Book::with('user')->where('public', true)->latest()->take(4)->get();
        return view('new.welcome', compact('books'));
    }

    public function about () {
        return view('new.about');
    }

    public function plans () {
        $plans = SubscriptionPlan::with('features.featureDetails')->get();
        return view('new.plans', compact('plans'));
    }

    public function categories () {
        $categories = Category::latest()->get();
        return view('new.categories', compact('categories'));
    }


    public function faqs () {
        $faqs = Faq::latest()->get();
        return view('new.faqs', compact('faqs'));
    }
}
