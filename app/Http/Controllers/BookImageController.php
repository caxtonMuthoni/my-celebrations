<?php

namespace App\Http\Controllers;

use App\Helpers\BookPDFGenerator;
use App\Helpers\FileOperationUtil;
use App\Models\BookImage;
use App\Http\Requests\StoreBookImageRequest;
use App\Http\Requests\UpdateBookImageRequest;
use App\Mail\BookImageDeleteUpdateMail;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BookImageController extends Controller
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
     * @param  \App\Http\Requests\StoreBookImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookImageRequest $request)
    {
        try {
            $bookId = $request->book_id;
            $userId = Auth::id();
            $book = Book::withCount('bookImages')->with('subscriptionPlan')->findOrFail($request->book_id);
            if (($book->book_images_count + count($request->images)) >= $book->subscriptionPlan?->pictures_per_book) {
                return response()->json([
                    'status' => false,
                    'message' => 'You can\'t add more than ' . $book->subscriptionPlan?->pictures_per_book . ' images to this book'
                ]);
            }

            foreach ($request->images as $image) {
                $fileUploadUtil = new FileOperationUtil($image, 'book-images');
                $path = $fileUploadUtil->uploadFile();
                $url = env('APP_URL') . Storage::url('book-images/' . $path);

                $bookImage = new BookImage();
                $bookImage->user_id = $userId;
                $bookImage->book_id = $bookId;
                $bookImage->email = $request->email;
                $bookImage->title = $request->title;
                $bookImage->name = $request->name;
                $bookImage->image = $url;
                $bookImage->published = true;
                $bookImage->save();
            }

            BookPDFGenerator::generatePDF($request->book_id);

            return response()->json([
                'status' => true,
                'message' => 'Images were uploaded successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred.'
            ]);
        }
    }

    public function friendImageUpload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required | file | mimes:png,jpg,jpeg,svg',
            'book_id' => 'required | integer'
        ]);

        try {
            $book = Book::withCount('bookImages')->with('subscriptionPlan')->findOrFail($request->book_id);
            // if ($book->book_images_count >= $book->subscriptionPlan->pictures_per_book) {
            //     return redirect()->back()->with('error', 'Sorry, You can\'t upload more images for this book');
            // }
            $bookId = $request->book_id;
            $userId = Auth::id();
            $image = $request->file('image');

            $fileUploadUtil = new FileOperationUtil($image, 'book-images');
            $path = $fileUploadUtil->uploadFile();
            $url = env('APP_URL') . Storage::url('book-images/' . $path);
            $email = $request->email;
            $token = $this->generateToken();

            $bookImage = new BookImage();
            $bookImage->user_id = $userId;
            $bookImage->book_id = $bookId;
            $bookImage->caption = $request->caption;
            $bookImage->image = str_replace(' ', '%20', $url);
            $bookImage->published = false;
            $bookImage->email = $email;
            $bookImage->token = $token;
            $bookImage->title = $request->title;
            $bookImage->name = $request->name;
            $bookImage->save();
            // sendmail
            $url = route('bookImageUpdateView') . "?token=$token&email=$email";
            Mail::to($request->email)->send(new BookImageDeleteUpdateMail($book, $bookImage, $url));
            return redirect()->route('readBookPDf', ['id' => $bookId])->with('success', 'The image was uploaded successfully');
        } catch (\Throwable $th) {
            $prefix = env('APP_URL') . "/storage/";
            $str = $bookImage->image;
            if (substr($str, 0, strlen($prefix)) == $prefix) {
                $str = substr($str, strlen($prefix));
                Storage::disk('public')->delete($str);
            }
            $bookImage->delete();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function generateToken()
    {
        return md5(rand(1, 10) . microtime());
    }

    public function toggleImageStatus($id)
    {
        $bookImage = BookImage::find($id);

        if ($bookImage) {
            $bookImage->published = !$bookImage->published;

            if ($bookImage->save()) {
                BookPDFGenerator::generatePDF($bookImage->book_id);
                return response()->json([
                    'status' => true,
                    'message' => 'Image status was updated successfully'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Image status could not be updated successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function show(BookImage $bookImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function bookImageUpdateView(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $bookImage = BookImage::where([['token', $token], ['email', $email]])->first();
        if(!isset($bookImage)) {
            return redirect('/');
        }

        $id = $bookImage->book_id;

        if (isset($bookImage)) {
            return view('book.updateimage', compact('email', 'token', 'bookImage', 'id'));
        } else {
            return redirect('/');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookImageRequest  $request
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookImageRequest $request, BookImage $bookImage)
    {
        try {
            $bookImage = BookImage::find($request->book_image_id);
            $bookId = $bookImage->book_id;
            $userId = Auth::id();
            $url = $bookImage->image;
            if ($request->hasFile('image')) {
                $prefix = env('APP_URL') . "/storage/";
                $str = $bookImage->image;
                if (substr($str, 0, strlen($prefix)) == $prefix) {
                    $str = substr($str, strlen($prefix));
                    Storage::disk('public')->delete($str);
                }

                $image = $request->file('image');
                $fileUploadUtil = new FileOperationUtil($image, 'book-images');
                $path = $fileUploadUtil->uploadFile();
                $url = env('APP_URL') . Storage::url('book-images/' . $path);
            }


            $bookImage->user_id = $userId;
            $bookImage->book_id = $bookId;
            $bookImage->caption = $request->caption;
            $bookImage->image = str_replace(' ', '%20', $url);
            $bookImage->email = $request->email;
            $bookImage->title = $request->title;
            $bookImage->name = $request->name;
            $bookImage->save();
            BookPDFGenerator::generatePDF($bookId);
            return redirect()->route('readBookPDf', ['id' => $bookId])->with('success', 'The image was updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function ownerImageDelete(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'token' => 'required',
        ]);

        $bookImage = BookImage::where([['token', $request->token], ['email', $request->email]])->first();
        $prefix = env('APP_URL') . "/storage/";
        $str = $bookImage->image;
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            $str = substr($str, strlen($prefix));
            Storage::disk('public')->delete($str);
        }

        $bookImage->delete();
        BookPDFGenerator::generatePDF($bookImage->book_id);
        return redirect()->route('readBookPDf', ['id' => $bookImage->book_id])->with('success', 'The image was deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookImage  $bookImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $bookImage = BookImage::find($id);
            $bookId = $bookImage->book_id;
            $prefix = env('APP_URL') . "/storage/";
            $str = $bookImage->image;
            if (substr($str, 0, strlen($prefix)) == $prefix) {
                $str = substr($str, strlen($prefix));
                Storage::disk('public')->delete($str);
            }

            $bookImage->delete();

            BookPDFGenerator::generatePDF($bookId);

            return response()->json([
                'status' => true,
                'message' => 'Image was deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred.'
            ]);
        }
    }
}
