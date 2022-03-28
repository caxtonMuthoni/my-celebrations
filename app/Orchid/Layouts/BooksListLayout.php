<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BooksListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'books';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('cover_image', 'Cover Image')->render(function ($book) {
                return view('orchid.table-image', [
                    'image' => $book->image
                ]);
            }),
            TD::make('title', 'Title'),
            TD::make('cover_message', 'Cover message'),
            TD::make('user_id', 'Author')->render(function ($book) {
                return $book->user->name;
            }),
            TD::make('category_id', 'Category')->render(function ($book) {
                return $book->category->name;
            }),
            TD::make('template_id', 'Template')->render(function ($book) {
                return $book->template->name;
            }),

            TD::make('public', 'Access')->render(function($book) {
               return view('orchid.book_access', [
                   'book_access' => $book->public
               ]);
            }),

            TD::make('published', 'Publication')->render(function($book) {
                return view('orchid.published', [
                    'book_access' => $book->published
                ]);
             }),

             TD::make('created_at', 'Created')->render(function ($book) {
                $createdAt = Carbon::parse($book->created_at);
                return $createdAt->format('d M, Y');
            }),
        ];
    }
}
