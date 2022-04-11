<?php

namespace App\Http\Controllers;

use App\Helpers\FileOperationUtil;
use App\Models\BookImage;
use App\Http\Requests\StoreBookImageRequest;
use App\Http\Requests\UpdateBookImageRequest;
use Illuminate\Support\Facades\Auth;
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
            foreach ($request->images as $image) {
                $fileUploadUtil = new FileOperationUtil($image, 'book-images');
                $path = $fileUploadUtil->uploadFile();
                $url = env('APP_URL') . Storage::url('book-images/' . $path);

                $bookImage = new BookImage();
                $bookImage->user_id = $userId;
                $bookImage->book_id = $bookId;
                $bookImage->image = $url;
                $bookImage->save();
            }

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
    public function edit(BookImage $bookImage)
    {
        //
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
        //
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
            $prefix = env('APP_URL') . "/storage/";
            $str = $bookImage->image;
            if (substr($str, 0, strlen($prefix)) == $prefix) {
                $str = substr($str, strlen($prefix));
                Storage::disk('public')->delete($str);
            }

            $bookImage->delete();

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
