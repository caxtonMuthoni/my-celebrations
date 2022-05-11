<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\Subscriber;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAsubscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $subsbscription = Subscriber::with('subscriptionPlan')->where([['user_id', Auth::id()], ['is_active', true]])->first();
        $books = Book::where('user_id', Auth::id())->count();
        if(!isset($subsbscription) && $books >= 1) {
            return redirect()->route('billing-plans')->with('error', 'Please subscribe in order to continue');
        }
        if($books >= $subsbscription->subscriptionPlan->total_number_books) {
            return redirect()->route('billing-plans')->with('error', 'You have reached the maximum number of books for your subscription.');
        }
        return $next($request);
    }
}
