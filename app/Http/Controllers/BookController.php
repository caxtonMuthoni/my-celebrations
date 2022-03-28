<?php

namespace App\Http\Controllers;

use App\Helpers\FileOperationUtil;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $fileUploadUtil = new FileOperationUtil($request->cover_image, 'cover_images');
        $fileUrl = $fileUploadUtil->uploadFile();
        $book =  new Book();
        $book->title = $request->title;
        $book->cover_message = $request->cover_message;
        $book->user_id = Auth::id();
        $book->category_id = $request->category_id;
        $book->template_id = $request->template_id;
        $book->public = $request->public;
        $book->published = $request->false;
        $book->accepting_message = $request->accepting_message;
        $book->cover_image = $fileUrl;
        if($book->save()) {
            return response()->json([
                'status' => true,
                'message' => "The book was created successfully"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
