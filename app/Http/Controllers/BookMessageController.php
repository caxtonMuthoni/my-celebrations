<?php

namespace App\Http\Controllers;

use App\Models\BookMessage;
use App\Http\Requests\StoreBookMessageRequest;
use App\Http\Requests\UpdateBookMessageRequest;
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
            $bookMessage = new BookMessage();
            $bookMessage->message = $request->message;
            $bookMessage->user_id = Auth::id();
            $bookMessage->book_id = $request->book_id;
            $bookMessage->relationship = $request->relationship;
            $bookMessage->save();
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
