<?php

namespace App\Http\Controllers;

use App\Helpers\BookPDFGenerator;
use App\Helpers\FileOperationUtil;
use App\Models\BookMessage;
use App\Http\Requests\StoreBookMessageRequest;
use App\Http\Requests\UpdateBookMessageRequest;
use App\Mail\BookImageDeleteUpdateMail;
use App\Mail\MessageDeleteUpdateMail;
use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
            $token = $this->generateToken();
            if ($book->book_messages_count >= $book->subscriptionPlan->messages_per_book) {
                return response()->json([
                    'status' => false,
                    'message' => 'You can and any more messages to this book'
                ]);
            }
            $email = $request->email;
            $bookMessage = new BookMessage();
            $bookMessage->message = $request->message;
            $bookMessage->user_id = Auth::id();
            $bookMessage->book_id = $request->book_id;
            $bookMessage->relationship = $request->relationship;
            $bookMessage->email = $email;
            $bookMessage->title = $request->title;
            $bookMessage->name = $request->name;
            $bookMessage->token = $token;
            $bookMessage->template_id = $request->template;
            $bookMessage->save();

            // sendmail
            $url = route('bookMessageUpdateView') . "?token=$token&email=$email";
            Mail::to($email)->send(new MessageDeleteUpdateMail($book, $bookMessage, $url));

            if ($book->publish_messages_to_book) {
                $bookMessage->public = true;
                $bookMessage->save();
                BookPDFGenerator::generatePDF($book->id);
            }

            // upload image
            $message = "";
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $message = $this->friendImageUpload($book->id, $image, $email, $request->caption, $request->title, $request->name);
            }

            return response()->json([
                'status' => true,
                'message' => 'Message was sent successfully. ' . $message
            ]);
        } catch (\Throwable $th) {
            $bookMessage->delete();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function friendImageUpload($bookId, $image, $email, $caption, $title, $name)
    {

        $bookImage = new BookImage();
        try {
            $book = Book::withCount('bookImages')->with('subscriptionPlan')->findOrFail($bookId);
            // if ($book->book_images_count >= $book->subscriptionPlan->pictures_per_book) {
            //     return 'Sorry, You can\'t upload more images for this book.';
            // }
            $userId = Auth::id();

            $fileUploadUtil = new FileOperationUtil($image, 'book-images');
            $path = $fileUploadUtil->uploadFile();
            $url = env('APP_URL') . Storage::url('book-images/' . $path);
            $email = $email;
            $token = $this->generateToken();

            $bookImage->user_id = $userId;
            $bookImage->book_id = $bookId;
            $bookImage->caption = $caption;
            $bookImage->image = str_replace(' ', '%20', $url);
            $bookImage->published = false;
            $bookImage->email = $email;
            $bookImage->token = $token;
            $bookImage->title = $title;
            $bookImage->name = $name;
            $bookImage->save();
            // sendmail
            $url = route('bookImageUpdateView') . "?token=$token&email=$email";
            Mail::to($email)->send(new BookImageDeleteUpdateMail($book, $bookImage, $url));
            return "Image was uploaded successfully.";
        } catch (\Throwable $th) {
            $prefix = env('APP_URL') . "/storage/";
            $str = $bookImage->image;
            if (substr($str, 0, strlen($prefix)) == $prefix) {
                $str = substr($str, strlen($prefix));
                Storage::disk('public')->delete($str);
            }
            $bookImage->delete();
            return "Image could not be uploaded. ";
        }
    }

    public function generateToken()
    {
        return md5(rand(1, 10) . microtime());
    }


    public function toggleMessageStatus($id)
    {
        $bookMessage = BookMessage::find($id);

        if ($bookMessage) {
            $bookMessage->public = !$bookMessage->public;

            if ($bookMessage->save()) {
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
     * 
     */

    public function bookMessageUpdateView(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $bookMessage = BookMessage::where([['token', $token], ['email', $email]])->first();
        $id = $bookMessage->book_id;

        if (isset($bookMessage)) {
            return view('book.updatemessage', compact('email', 'token', 'bookMessage', 'id'));
        } else {
            return redirect('/');
        }
    }
    public function update(UpdateBookMessageRequest $request, BookMessage $bookMessage)
    {
        $bookMessage = BookMessage::find($request->book_message_id);
        $bookMessage->message = $request->message;
        $bookMessage->user_id = Auth::id();
        $bookMessage->book_id = $request->book_id;
        $bookMessage->relationship = $request->relationship;
        $bookMessage->email = $request->email;
        $bookMessage->title = $request->title;
        $bookMessage->name = $request->name;
        $bookMessage->save();
        BookPDFGenerator::generatePDF($bookMessage->book_id);

        return response()->json([
            'status' => true,
            'message' => 'Message was updated successfully'
        ]);
    }


    public function ownerMessageDelete(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'token' => 'required',
        ]);

        $message = BookMessage::where([['token', $request->token], ['email', $request->email]])->first();
        $message->delete();
        BookPDFGenerator::generatePDF($message->book_id);
        return response()->json([
            'status' => true,
            'message' => 'Message was sent successfully'
        ]);
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
