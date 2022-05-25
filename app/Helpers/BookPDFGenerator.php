<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\BookPdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\File;

class BookPDFGenerator {

    public static function generatePDF(int $id) {
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
    }
}