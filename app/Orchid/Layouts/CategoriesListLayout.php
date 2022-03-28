<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\Category;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoriesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('image', 'Category Image')->render(function(Category $category) {
                return view('orchid.table-image', [
                    'image' => $category->image
                ]) ;
            }),
            TD::make('name', 'Category Name'),
            TD::make('created_at', 'Created')->render(function (Category $category) {
                $createdAt = Carbon::parse($category->created_at);
                return $createdAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('updated_at', 'Last edit')->render(function (Category $category) {
                $updatedAt = Carbon::parse($category->updated_at);
                return $updatedAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('', 'Action')
                ->render(function (Category $category) {
                    return Link::make()
                        ->icon('pencil')
                        ->class('text-primary')
                        ->route('platform.dashboard.category.edit', $category);
                }),
        ];
    }
}
