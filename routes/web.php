<?php

use App\Helpers\BookPDFGenerator;
use App\Helpers\TemplatesNumberGetter;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\BookMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialiteCOntroller;
use App\Mail\MessageDeleteUpdateMail;
use App\Models\Book;
use App\Models\BookMessage;
use App\Payment\MpesaSubscription;
use App\Payment\PaypalSubscription;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

Route::get('/', [HomeController::class, 'home']);
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');

Route::post('/contactUs', [HomeController::class, 'contactUs'])->name('contact-us-form');
Route::get('/reload-captcha', [HomeController::class, 'reloadCaptcha']);

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
Route::get('books/public', [BookController::class, 'publicBooks'])->name('book-public-show');

Route::group([
    'middleware' => ['auth', 'verified'],
    'prefix' => 'book'
], function () {

    Route::group([
        'middleware' => ['subscriber']
    ], function () {
        Route::get('create', [BookController::class, 'create'])->name('book-create');
    });

    Route::get('content/{id}', [BookController::class, 'bookContent'])->name('book-content');
    Route::get('mybooks', [BookController::class, 'myBooks'])->name('my-books');
    Route::get('book/{book}', [BookController::class, 'show'])->name('book-show');
    Route::get('books/read/{id}', [BookController::class, 'readBook'])->name('book-read');
    Route::get('messages/and/pictures/{id}', [BookController::class, 'viewMessagesAndPictures'])->name('book-view-messages-pictures');
    Route::get('publish/book/{id}', [BookController::class, 'publishBook'])->name('publish-book');
    Route::get('/print/book/{id}', [BookController::class, 'printBook'])->name('print-book');
    Route::get('/print/temp/{id}', [BookController::class, 'bookTemplateCreate'])->name('print-book-template');
    Route::get('/book/edit/details/{id}', [BookController::class, 'bookEditView'])->name('edit-book-details');
    Route::post('/book/update/details/{id}', [BookController::class, 'update'])->name('update-book-details');
    Route::get('/book/transfer/{id}', [BookController::class, 'bookTransferView'])->name('book-transfer');
    Route::get('/book/accept/transfer/{token}', [BookController::class, 'bookAcceptBook'])->name('accept_book_transfer');
    Route::post('/book/request/transfer/{id}', [BookController::class, 'transferBookRequest'])->name('book-request-transfer');
});

Route::group([
    'prefix' => 'book'
], function () {
    Route::get('/book/pdf/read/{id}', [BookController::class, 'readBookPDf'])->name('readBookPDf');
    Route::get('books/message/{id}', [BookController::class, 'bookMessage'])->name('book-message');
    Route::get('books/images/{id}', [BookController::class, 'bookImages'])->name('book-images');
    Route::get('/message/update/view', [BookMessageController::class, 'bookMessageUpdateView'])->name('bookMessageUpdateView');
    Route::get('/image/update/view', [BookImageController::class, 'bookImageUpdateView'])->name('bookImageUpdateView');
    Route::post('/upload/bookimage', [BookImageController::class, 'friendImageUpload'])->name('friend-upload-image');
    Route::post('/image/update', [BookImageController::class, 'update'])->name('update-book-image');
    Route::get('/image/delete', [BookImageController::class, 'ownerImageDelete'])->name('owner-delete-book-image');
});

Route::group([
    'middleware' => ['auth', 'verified'],
    'prefix' => 'billing'
], function () {
    Route::get('plans', [BillingController::class, 'plans'])->name('billing-plans');
    Route::get('payments/{id}', [BillingController::class, 'payments'])->name('billing-payments');
    Route::get('mpesa/{id}', [BillingController::class, 'mpesaView'])->name('billing-mpesa');
    Route::get('pin/mpesa/{id}', [BillingController::class, 'mpesaPopUp'])->name('billing-mpesapopup');
    Route::get('confirm/mpesa/{id}', [BillingController::class, 'mpesaConfirmTransaction'])->name('billing-mpesa-confirm');
    Route::post('mpesa/stkpush', [BillingController::class, 'payWithMpesa'])->name('billing-with-mpesa');

    Route::get('paypal/view/{id}', [BillingController::class, 'paypalView'])->name('billing-paypal-view');
});

Route::get('/new/design', function() {
    $books = Book::with('user')->where('public', true)->latest()->take(4)->get();
    return view('layouts.welcome', compact('books'));
});

Route::get('test', function () {
    $book = Book::latest()->first();
    $bookMessage = BookMessage::latest()->first();
    $token = $bookMessage->token;
    $email = $bookMessage->email;
    $url = route('bookMessageUpdateView')."?token=$token&email=$email";
    Mail::to("githinjicaxton323@gmail.com")->send(new MessageDeleteUpdateMail($book, $bookMessage, $url));
    return response()->json(['status' => 'sent']);
});



