<?php

use App\Http\Controllers\BookContentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\BookMessageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TemplateController;
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
], function() {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('templates', [TemplateController::class, 'index']);
    Route::post('book', [BookController::class, 'store']);
    Route::post('bookcontent', [BookContentController::class, 'store']);
    Route::post('bookcontent/update', [BookContentController::class, 'update']);
    Route::post('bookimages', [BookImageController::class ,'store']);
    Route::delete('bookimage/{id}', [BookImageController::class, 'destroy']);
    Route::delete('bookmessage/{id}', [BookMessageController::class, 'destroy']);

});


Route::get('books/{id}', [BookController::class, 'readBookContentApi']);
