<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SocialiteCOntroller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Mail verification
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('resent', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Socialite

Route::get('auth/google', [SocialiteCOntroller::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteCOntroller::class, 'handleGoogleCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['verified', 'auth']);

Route::group([
    'middleware' => ['auth', 'verified'],
    'prefix' => 'book'
], function() {
      Route::get('create', [BookController::class, 'create'])->name('book-create');
      Route::get('content/{id}', [BookController::class, 'bookContent'])->name('book-content');
      Route::get('mybooks', [BookController::class, 'myBooks'])->name('my-books');
      Route::get('book/{book}', [BookController::class, 'show'])->name('book-show');
      Route::get('books/public', [BookController::class, 'publicBooks'])->name('book-public-show');
      Route::get('books/read/{id}', [BookController::class, 'readBook'])->name('book-read');
      Route::get('books/message/{id}', [BookController::class, 'bookMessage'])->name('book-message');
      Route::get('books/images/{id}', [BookController::class, 'bookImages'])->name('book-images');
});


Route::group([
    'middleware' => ['auth', 'verified'],
    'prefix' => 'billing'
], function() {
      Route::get('plans', [BillingController::class, 'plans'])->name('billing-plans');
      Route::get('payments/{id}', [BillingController::class, 'payments'])->name('billing-payments');
});


Route::get('template', function() {
    return File::get(public_path() . '\templates\book\dist\index.html?id=1');
});