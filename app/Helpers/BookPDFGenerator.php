<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\BookPdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use DOMDocument;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;

class BookPDFGenerator
{

    public static function generatePDF(int $id)
    {
        ini_set('max_execution_time', 1200);
        $book = Book::with(['user', 'template.template_file', 'content', 'bookMessages.user', 'bookMessages'  => function ($query) {
            $query->where('public', true);
        },  'bookImages' => function ($query) {
            $query->where('published', true);
        }])->find($id);

        $file = self::createDocx($book);
        $bookPath = self::convertDocxToPDF($file);

        // $data = ['book' => $book];
        // $pdf = SnappyPdf::loadView('book.book-print', $data)->setOption('page-height', '10');;
        // $pdf->save(public_path($bookPath));

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

    private static function createDocx(Book $book)
    {
        $template = public_path() . $book->template->template_file->relativeUrl;
        $templateProcesser = new TemplateProcessor($template);
        $templateProcesser->setImageValue(
            'cover_image',
            array(
                'path' => self::getImageRelativePathFromURL($book->image),
                'width' => 150,
                'height' => 150,
                'ratio' => false
            )
        );
        $templateProcesser->setValue('title', $book->title);
        $templateProcesser->setValue('cover_message', $book->cover_message);
        $templateProcesser->setValue('author', $book->user->name);
        $table = new Table();
        $table->addRow();
        $cell = $table->addCell();
        $doc = new DOMDocument();
        $doc->loadHTML($book->content->content);
        Html::addHtml($cell, $doc->saveXML(), true);
        $templateProcesser->setComplexBlock('content', $table);

        // book images
        $images = $book->bookImages;
        if ($images) {
            $templateProcesser->cloneBlock('book_image', count($images), true, true);
            foreach ($images as $key => $image) {
                $templateProcesser->setImageValue(
                    "book_image_photo#" . $key + 1,
                    array(
                        'path' => self::getImageRelativePathFromURL($image['image']),
                        'width' => 500,
                        'height' => 500
                    )
                );
                $templateProcesser->setValue("book_image_caption#" . $key + 1, ($key + 1) . ": " . $image['caption']);
            }
        }

        // book messages
        $messages = $book->bookMessages;
        if ($messages) {
            $templateProcesser->cloneBlock('book_messages', count($messages), true, true);
            foreach ($messages as $key => $message) {
                $templateProcesser->setValue(
                    "book_message#" . $key + 1,
                    $message->message
                );
                $templateProcesser->setValue("book_message_user#" . $key + 1, ($key + 1) . ": " . $message['user']['name']);
                $templateProcesser->setValue("book_message_relationship#" . $key + 1, ($key + 1) . ": " . $message['relationship']);
            }
        }


        $file = $book->title . "_" . date('y-m-d') . '_' . time() . ".pdf";;
        $templateProcesser->saveAs($file);
        return $file;
    }

    private static function convertDocxToPDF($file)
    {
        
        $bookPath = './books/pdfs/';
        // Execute command(Libreoffice)
        $convert = shell_exec("soffice  --headless --convert-to pdf --outdir ".$bookPath . " ". $file);
        if ($convert) {
            unlink($file);
            return "books/pdfs/$file";
        } else {
            return false;
        }
    }

    private static function getImageRelativePathFromURL(string $url)
    {
        $baseUrl = env('APP_URL');
        return public_path() . substr($url, \strlen($baseUrl));
    }
}
