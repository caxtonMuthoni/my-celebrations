<?php

namespace App\Http\Controllers;

use App\Helpers\BookPDFGenerator;
use App\Models\BookMessage;
use App\Http\Requests\StoreBookMessageRequest;
use App\Http\Requests\UpdateBookMessageRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookMessageController extends Controller
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
     * @param  \App\Http\Requests\StoreBookMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookMessageRequest $request)
    {
        try {
            $book = Book::withCount('bookMessages')->with('subscriptionPlan')->findOrFail($request->book_id);
            if($book->book_messages_count >= $book->subscriptionPlan->messages_per_book) {
                return response()->json([
                    'status' => false,
                    'message' => 'You can and any more messages to this book'
                ]);
            }
            $bookMessage = new BookMessage();
            $bookMessage->message = $request->message;
            $bookMessage->user_id = Auth::id();
            $bookMessage->book_id = $request->book_id;
            $bookMessage->relationship = $request->relationship;
            $bookMessage->template_id = $request->template;
            $bookMessage->save();

            if($book->publish_messages_to_book) {
                $bookMessage->public = true;
                $bookMessage->save();
                BookPDFGenerator::generatePDF($book->id);
            }
            return response()->json([
                'status' => true,
                'message' => 'Message was sent successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred.'
            ]);
        }
    }


    public function toggleMessageStatus($id){
        $bookMessage = BookMessage::find($id);

        if($bookMessage) {
              $bookMessage->public = !$bookMessage->public;

              if($bookMessage->save()) {
                BookPDFGenerator::generatePDF($bookMessage->book_id);
                return response()->json([
                    'status' => true,
                    'message' => 'Message status was updated successfully'
                ]);
              }
        }

        return response()->json([
            'status' => false,
            'message' => 'Message status could not be updated successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookMessage  $bookMessage
     * @return \Illuminate\Http\Response
     */
    public function show(BookMessage $bookMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookMessage  $bookMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(BookMessage $bookMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookMessageRequest  $request
     * @param  \App\Models\BookMessage  $bookMessage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookMessageRequest $request, BookMessage $bookMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookMessage  $bookMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $bookMessage = BookMessage::find($id);
            $bookMessage->delete();
            return response()->json([
                'status' => true,
                'message' => 'Message was deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred.'
            ]);
        }
    }
}
