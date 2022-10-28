<?php

use App\Http\Controllers\BookContentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\BookMessageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TemplateController;
use App\Payment\MpesaSubscription;
use App\Payment\PaypalSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'celebrations',
    'middleware' => 'auth:api'
], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('templates/{id}', [TemplateController::class, 'index']);
    Route::get('templates/messages', [TemplateController::class, 'messages']);
    Route::post('book', [BookController::class, 'store']);
    Route::post('bookcontent', [BookContentController::class, 'store']);
    Route::post('bookcontent/update', [BookContentController::class, 'update']);
    Route::post('bookimages', [BookImageController::class, 'store']);
    Route::delete('bookimage/{id}', [BookImageController::class, 'destroy']);
    Route::delete('bookmessage/{id}', [BookMessageController::class, 'destroy']);
    Route::post('togglebookstatus/{id}', [BookMessageController::class, 'toggleMessageStatus']);
    Route::post('togglebookimagestatus/{id}', [BookImageController::class, 'toggleImageStatus']);
});

Route::group([
    'prefix' => 'celebrations',
], function () { 
    Route::post('message', [BookMessageController::class, 'store']);
    Route::post('message/update', [BookMessageController::class, 'update']);
    Route::delete('message/delete', [BookMessageController::class, 'ownerMessageDelete']);
});


Route::get('books/{id}', [BookController::class, 'readBookContentApi']);

Route::group([
    'prefix' => 'billing',
    'middleware' => 'auth:api',
], function () {
    Route::post('/add/subscription', [PaypalSubscription::class, 'addPayPalSubscription']);
});

// callbacks
Route::group([
    'prefix' => 'billing'
], function () {
    Route::post('/callback/mpesa', [MpesaSubscription::class, 'callback'])->name('billing-mpesa-callback');
});

