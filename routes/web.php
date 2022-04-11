<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => 'auth',
    'prefix' => 'book'
], function() {
      Route::get('create', [BookController::class, 'create'])->name('book-create');
      Route::get('content/{id}', [BookController::class, 'bookContent'])->name('book-content');
      Route::get('mybooks', [BookController::class, 'myBooks'])->name('my-books');
      Route::get('book/{book}', [BookController::class, 'show'])->name('book-show');
      Route::get('books/public', [BookController::class, 'publicBooks'])->name('book-public-show');
      Route::get('books/read/{id}', [BookController::class, 'readBook'])->name('book-read');
});


Route::group([
    'middleware' => 'auth',
    'prefix' => 'billing'
], function() {
      Route::get('plans', [BillingController::class, 'plans'])->name('billing-plans');
      Route::get('payments/{id}', [BillingController::class, 'payments'])->name('billing-payments');
});
