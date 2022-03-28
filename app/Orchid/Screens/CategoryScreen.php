<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use App\Orchid\Layouts\CategoriesListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'categories' => Category::paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Book categories';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('New Category')
                ->icon('pencil')
                ->route('platform.dashboard.category.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            CategoriesListLayout::class,
        ];
    }
}
