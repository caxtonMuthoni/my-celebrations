<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\Faq;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FaqsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'faqs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('question', 'Question'),
            TD::make('answer', 'Answer'),
            TD::make('updated_at', 'Last edit')->render(function (Faq $faq) {
                $updatedAt = Carbon::parse($faq->updated_at);
                return $updatedAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('', 'Remove')
            ->render(function (Faq $faq) {
                return Link::make('')->icon('pencil')->route('platform.dashboard.faq-edit', $faq);
            }),
        ];
    }
}
