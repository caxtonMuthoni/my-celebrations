<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\Template;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TemplateListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'templates';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('image', 'Template Image')->render(function (Template $template) {
                return view('orchid.table-image', [
                    'image' => $template->image?->url
                ]);
            }),
            TD::make('name', 'Template Name'),
            TD::make('description', 'Template Description'),
            TD::make('created_at', 'Created')->render(function (Template $template) {
                $createdAt = Carbon::parse($template->created_at);
                return $createdAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('updated_at', 'Last edit')->render(function (Template $template) {
                $updatedAt = Carbon::parse($template->updated_at);
                return $updatedAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('', 'Action')
                ->render(function (Template $template) {
                    return Link::make()
                        ->icon('pencil')
                        ->class('text-primary')
                        ->route('platform.dashboard.template.edit', $template);
                }),
        ];
    }
}
