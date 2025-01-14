<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\BookPdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;

class BookPDFGenerator
{

    public static function generatePDF(int $id)
    {
        ini_set('max_execution_time', 1200);
        $book = Book::with(['user', 'template.template_file', 'content', 'bookMessages'  => function ($query) {
            $query->where('public', true);
        },  'bookImages' => function ($query) {
            $query->where('published', true)->with('user');
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
        try {
            $template = public_path() . $book->template?->template_file?->relativeUrl;
            $templateProcesser = new TemplateProcessor($template);
            $templateProcesser->setImageValue(
                'cover_image',
                array(
                    'path' => self::getImageRelativePathFromURL($book->image),
                    'width' => 250,
                    'height' => 250,
                    'ratio' => false
                )
            );
            $templateProcesser->setValue('title', $book->title);
            $templateProcesser->setValue('cover_message', $book->cover_message);
            $templateProcesser->setValue('author', $book->user->name);
            // set error level
            $internalErrors = libxml_use_internal_errors(true);
            $table = new Table();
            $table->addRow();
            $cell = $table->addCell();
            $doc = new DOMDocument();
            $content = $book->content->content;
            $content = htmlspecialchars_decode($content);
            $content = str_replace(' & ', ' and ', $content);
            $doc->loadHTML($content);
            Html::addHtml($cell, $doc->saveXML(), true);
            $templateProcesser->setComplexBlock('content', $table);
            libxml_use_internal_errors($internalErrors);

            // book images
            $bookUserImages = Book::with(['bookImages' => function ($query) use ($book) {
                $query->where('user_id', $book->user_id);
            }])->find($book->id);


            $images = $bookUserImages->bookImages;

            if ($images) {
                $images = $images->toArray();
                $imageChunks = array_chunk($images, 2);
                $templateProcesser->cloneBlock('book_image', count($imageChunks), true, true);
                foreach ($imageChunks as $key => $image) {
                    $templateProcesser->setImageValue(
                        "book_image_photo#" . $key + 1,
                        array(
                            'path' => self::getImageRelativePathFromURL($image[0]['image']),
                            'width' => 350,
                            'height' => 250,
                            'ratio' => true
                        )
                    );

                    $templateProcesser->setValue("book_image_caption#" . $key + 1, $image[0]['caption']);
                    if (count($image) > 1) {
                        $templateProcesser->setImageValue(
                            "book_image_photo_left#" . $key + 1,
                            array(
                                'path' => self::getImageRelativePathFromURL($image[1]['image']),
                                'width' => 350,
                                'height' => 250,
                                'ratio' => true
                            )
                        );
                        $templateProcesser->setValue("book_image_caption_left#" . $key + 1, $image[1]['caption']);
                    } else {
                        $templateProcesser->setValue(
                            "book_image_photo_left#" . $key + 1,
                            ' '
                        );
                        $templateProcesser->setValue("book_image_caption_left#" . $key + 1, ' ');
                    }
                }
            }

            // friend images
            $bookUserImages = Book::with(['bookImages' => function ($query) use ($book) {
                $query->where('user_id', '!=',  $book->user_id)->orWhereNull('user_id');
            }])->find($book->id);

            $images = $bookUserImages->bookImages;

            if ($images) {
                $images = $images->toArray();
                $imageChunks = array_chunk($images, 2);
                $templateProcesser->cloneBlock('book_friend_image', count($imageChunks), true, true);
                foreach ($imageChunks as $key => $image) {
                    $templateProcesser->setImageValue(
                        "book_friend_image_photo#" . $key + 1,
                        array(
                            'path' => self::getImageRelativePathFromURL($image[0]['image']),
                            'width' => 550,
                            'height' => 550,
                            'ratio' => true
                        )
                    );

                    $templateProcesser->setValue("book_friend_image_caption#" . $key + 1, $image[0]['caption']);
                    if (count($image) > 1) {
                        $templateProcesser->setImageValue(
                            "book_friend_image_photo_left#" . $key + 1,
                            array(
                                'path' => self::getImageRelativePathFromURL($image[1]['image']),
                                'width' => 350,
                                'height' => 250,
                                'ratio' => true
                            )
                        );
                        $templateProcesser->setValue("book_friend_image_caption_left#" . $key + 1, $image[1]['caption']);
                    } else {
                        $templateProcesser->setValue(
                            "book_friend_image_photo_left#" . $key + 1,
                            ' '
                        );
                        $templateProcesser->setValue("book_friend_image_caption_left#" . $key + 1, ' ');
                    }
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
                    $userName = $message['name'] ?? $message['user']['name'];
                    $templateProcesser->setValue("book_message_user#" . $key + 1, $message['title'] . " " . $userName);
                    $templateProcesser->setValue("book_message_relationship#" . $key + 1,  $message['relationship']);
                }
            }


            $file = $book->title . "_" . date('y-m-d') . '_' . time();
            $file = str_replace(' ', '_', $file);
            ob_clean();
            $templateProcesser->saveAs($file . ".docx");
            return $file;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private static function convertDocxToPDF($file)
    {

        $bookPath = './books/pdfs/';
        $command = "soffice  --headless --convert-to pdf --outdir " . $bookPath . " " . $file . ".docx";
        // Execute command(Libreoffice)
        $convert = exec($command);
        if ($convert) {
            unlink($file . ".docx");
            return "books/pdfs/$file" . ".pdf";
        } else {
            unlink($file . ".docx");
            return false;
        }
    }

    private static function getImageRelativePathFromURL(string $url)
    {
        $baseUrl = env('APP_URL');
        return public_path() . substr($url, \strlen($baseUrl));
    }
}
