<?php

namespace App\Http\Controllers;

use App\Helpers\BookPDFGenerator;
use App\Helpers\FileOperationUtil;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\BookPdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Barryvdh\Snappy\Facades\SnappyPdf;
// use niklasravnsborg\LaravelPdf\Facades\Pdf;

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

    public function readBookPDf($id)
    {
        $book = Book::find($id);
        $pdfurl =  BookPdf::where('book_id', $id)->value('pdfurl');
        $builder = new \AshAllenDesign\ShortURL\Classes\Builder();

        $shortURLObject = $builder->destinationUrl(route('readBookPDf', $id))->make();
        $shorturl = $shortURLObject->default_short_url;
        return view('book.book-pdf-read', compact('pdfurl', 'shorturl', 'book'));
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
        if ($book->save()) {
            $book = $book->refresh();
            return response()->json([
                'status' => true,
                'id' => $book->id,
                'message' => "The book was created successfully"
            ]);
        }
    }

    public function bookContent($id)
    {
        $book = Book::with('bookImages')->find($id);
        return view('book.content', compact('book', 'id'));
    }

    public function myBooks()
    {
        $books = Auth::user()->books;
        return view('book.mybooks', compact('books'));
    }

    public function bookEditView($id) {
        $book = Book::find($id);
        return view('book.detailedit', compact('book'));
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

    public function publicBooks()
    {
        $books = Book::where([['public', 1], ['published', true]])->latest()->paginate();
        return view('book.public-books', compact('books'));
    }

    public function readBook($id)
    {
        $book = Book::with('template')->find($id);
        $book = Book::find($id);
        $pdfurl =  BookPdf::where('book_id', $id)->value('pdfurl');
        $shorturl = 'none';
        return view('book.book-read', compact('pdfurl', 'shorturl', 'id', 'book'));
    }

    public function printBook($id)
    {
        
        $book = Book::with(['template', 'content', 'bookMessages.user', 'bookMessages'  => function ($query) {
            $query->where('public', true);
        },  'bookImages' => function ($query) {
            $query->where('published', true);
        }])->find($id);

        $data = ['book' => $book];
        $pdf = SnappyPdf::loadView('book.book-print', $data)->setOption('page-height', '10');;
        $bookName = $book->title . "_" . date('y-m-d') . '_' . time() . ".pdf";
        $bookPath = 'books/pdfs/' . $bookName;
        $pdf->save(public_path($bookPath));
        $pdfUrl = env('APP_URL') . '/' . $bookPath;
        // Save link
        $bookPDF = BookPdf::where('book_id', $id)->first();
        if (isset($bookPDF)) {
            // Delete pdf
            $file = public_path() . substr($bookPDF->pdfurl, strlen(env('APP_URL')));
            if (File::exists($file)) {
                File::delete($file);
            }
        } else {
            $bookPDF = new BookPdf();
        }

        $bookPDF->book_id = $id;
        $bookPDF->pdfurl = $pdfUrl;
        $bookPDF->save();

        return view('book.book-print', compact('id', 'book'));
    }

    public function readBookContentApi($id)
    {
        $book = Book::with(['content', 'bookMessages.user', 'bookMessages'  => function ($query) {
            $query->where('public', true);
        },  'bookImages' => function ($query) {
            $query->where('published', true);
        }])->find($id);
        return $book;
    }

    public function publishBook($id)
    {
        $book = Book::where([['user_id', Auth::id()], ['id', $id]])->first();
        if (isset($book)) {
            $book->published = !$book->published;
            $book->save();
            BookPDFGenerator::generatePDF($id);

            return redirect()->back()->with('success', 'The book was published successfully');
        }

        return redirect()->back()->with('error', 'The book could not be published published, try again later');
    }

    public function bookMessage($id)
    {
        return view('book.message', compact('id'));
    }

    public function bookImages($id)
    {
        return view('book.images', compact('id'));
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
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::where([['user_id', Auth::id()], ['id', $id]])->first();
        $book->title = $request->title;
        $book->cover_message = $request->cover_message;
        $book->public = $request->public ?? 0;
        $book->accepting_message = $request->accepting_message ?? 0;
        if($book->save()) {
            return redirect()->route('my-books')->with('success', 'The book was updated successfully.');
        }
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

    public function bookTemplateCreate($id) {
        $book = Book::with(['template', 'content', 'bookMessages.user', 'bookMessages'  => function ($query) {
            $query->where('public', true);
        },  'bookImages' => function ($query) {
            $query->where('published', true);
        }])->find($id);
        return view('book.book-template', compact('id', 'book'));
    }
}
