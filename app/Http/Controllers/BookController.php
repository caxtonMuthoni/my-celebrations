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
        $book->category_id = $request->category;
        $book->template_id = $request->template;
        $book->public = filter_var($request->public, FILTER_VALIDATE_BOOLEAN);
        $book->published = false;
        $book->accepting_message = filter_var($request->accepting_message, FILTER_VALIDATE_BOOLEAN);
        $book->cover_image = $fileUrl;
        if($book->save()) {
            $book = $book->refresh();
            return response()->json([
                'status' => true,
                'id' => $book->id,
                'message' => "The book was created successfully"
            ]);
        }
    }

    public function bookContent($id) {
        $book = Book::with('bookImages')->find($id);
        return view('book.content', compact('book', 'id'));
    }

    public function myBooks() {
        $books = Auth::user()->books;
        return view('book.mybooks', compact('books'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('content', 'bookImages', 'bookMessages.user')->find($id);
        $content = $book->content;
        return view('book.edit', compact('book', 'content'));
    }

    public function publicBooks(){
        $books = Book::where('public', 1)->latest()->paginate();
        return view('book.public-books', compact('books'));
    }

    public function readBook($id) {
          $book = Book::with('content')->find($id);
          return view('book.book-read', compact('book'));
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
