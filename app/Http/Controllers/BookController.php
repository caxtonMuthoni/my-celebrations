<?php

namespace App\Http\Controllers;

use App\Helpers\BookPDFGenerator;
use App\Helpers\FileOperationUtil;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Mail\BookTransferMail;
use App\Models\BookImage;
use App\Models\BookMessage;
use App\Models\BookPdf;
use App\Models\BookTransfer;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $plan = Subscriber::where([['user_id', Auth::id()], ['is_active', true]])->first();
        if (!isset($plan)) {
            $plan = SubscriptionPlan::where('name', 'like', '%bronze%')->first();
            $subscriber = new Subscriber();
            $subscriber->user_id = Auth::id();
            $subscriber->subscription_plan_id = $plan->id;
            $subscriber->is_active = true;
            $subscriber->save();

            $plan = $subscriber->refresh();
        }

        $book =  new Book();
        $book->title = $request->title;
        $book->cover_message = $request->cover_message;
        $book->user_id = Auth::id();
        $book->category_id = $request->category;
        $book->template_id = $request->template;
        $book->public = filter_var($request->public, FILTER_VALIDATE_BOOLEAN);
        $book->published = false;
        $book->accepting_message = filter_var($request->accept_message, FILTER_VALIDATE_BOOLEAN);
        $book->publish_messages_to_book = filter_var($request->publish_messages_to_book, FILTER_VALIDATE_BOOLEAN);
        $book->cover_image = $fileUrl;
        $book->subscription_plan_id = $plan->subscription_plan_id;
        if ($book->save()) {
            $book = $book->refresh();
            $plan->is_active = false;
            $plan->save();
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

    public function bookEditView($id)
    {
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
        $book = Book::with(['content', 'bookImages' => function ($query) {
            $query->where('user_id', Auth::id());
        }, 'bookMessages.user'])->find($id);
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
        if ($book->save()) {
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

    public function bookTemplateCreate($id)
    {
        $book = Book::with(['template', 'content', 'bookMessages.user', 'bookMessages'  => function ($query) {
            $query->where('public', true);
        },  'bookImages' => function ($query) {
            $query->where('published', true);
        }])->find($id);
        return view('book.book-template', compact('id', 'book'));
    }


    public function bookTransferView($id)
    {
        return view('book.book-transfer', compact('id'));
    }

    public function transferBookRequest(Request $request, $id)
    {

        // validation
        $this->validate($request, [
            'email' => 'required | email | exists:users'
        ]);

        if (Auth::user()->email ==  $request->email) {
            return redirect()->back()->with('error', 'You can\'t transfer the book to your own account.');
        }

        $book = Book::where([['user_id', Auth::id()], ['id', $id]])->first();

        if (isset($book)) {
            $token  = time() * random_int(10, 1000);
            $toUser = User::where('email', $request->email)->first();
            $bookTransfer = new BookTransfer();
            $bookTransfer->from_user_id = Auth::id();
            $bookTransfer->to_user_id = $toUser->id;
            $bookTransfer->transfer_token = $token;
            $bookTransfer->book_id = $book->id;
            $bookTransfer->save();

            Mail::to($toUser->email)->send(new BookTransferMail($book, $toUser, $token));

            // send mail
            return redirect()->back()->with('success', 'The book transfer request was sent successfully');
        }

        return redirect()->back()->with('error', 'Sorry, the book does not exist.');
    }

    public function bookAcceptBook($token)
    {
        $transfer = BookTransfer::where('transfer_token', $token)->first();

        if (isset($transfer)) {

            if ($transfer->to_user_id != Auth::id()) {
                return redirect()->route('home')->with('error', 'Oops! You are not allowed to complete this process.');
            }

            $book = Book::find($transfer->book_id);

            if (isset($book)) {
                $book->user_id = $transfer->to_user_id;
                if ($book->save()) {
                    return redirect()->route('my-books')->with('success', 'The book was added to your books successfully.');
                }
            }
        }
        return redirect()->route('home')->with('error', 'Oops! an error occured during the process please try again later.');
    }

    public function viewMessagesAndPictures($id)
    {
        $messages = BookMessage::with('user')->where('book_id', $id)->get();
        $pictures = BookImage::with('user')->where('book_id', $id)->get();
        return view('book.book-pictures-messages', compact('messages', 'pictures'));
    }
}
