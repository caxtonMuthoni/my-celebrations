<?php

namespace App\Http\Controllers;

use App\Helpers\BookPDFGenerator;
use App\Models\BookContent;
use App\Http\Requests\StoreBookContentRequest;
use App\Http\Requests\UpdateBookContentRequest;
use App\Models\Book;

class BookContentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookContentRequest $request)
    {
        $bookContent = new BookContent();
        $bookContent->content = $request->content;
        $bookContent->book_id = $request->book_id;
        $bookContent->page = $request->page;
        if($bookContent->save()) {
            BookPDFGenerator::generatePDF($request->book_id);
            return response()->json([
                'status' => true,
                'message' => "The book content was uploaded"
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "An error occurred"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function show(BookContent $bookContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function edit(BookContent $bookContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookContentRequest  $request
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookContentRequest $request)
    {
        $bookContent = BookContent::find($request->book_id);
        $bookContent->content = $request->content;
        // $bookContent->book_id = $request->book_id;
        $bookContent->page = $request->page;
        if($bookContent->save()) {
            BookPDFGenerator::generatePDF($request->book_id);
            return response()->json([
                'status' => true,
                'message' => "The book content was uploaded"
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "An error occurred"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookContent $bookContent)
    {
        //
    }
}
