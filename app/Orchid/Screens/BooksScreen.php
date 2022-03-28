<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use App\Orchid\Layouts\BooksListLayout;
use Orchid\Screen\Screen;

class BooksScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'books' => Book::with('category', 'template')->latest()->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'All created Books';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            BooksListLayout::class
        ];
    }
}
