<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\SubscriptionFeature;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SubscriptionFeaturesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'features';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Feature Name'),
            TD::make('description', 'Feature Description'),
            TD::make('created_at', 'Created')->render(function (SubscriptionFeature $feature) {
                $createdAt = Carbon::parse($feature->created_at);
                return $createdAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('updated_at', 'Last edit')->render(function (SubscriptionFeature $feature) {
                $updatedAt = Carbon::parse($feature->updated_at);
                return $updatedAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('', 'Action')
                ->render(function (SubscriptionFeature $feature) {
                    return Link::make()
                        ->icon('pencil')
                        ->class('text-primary')
                        ->route('platform.dashboard.subscription-features-edit', $feature);
                }),
        ];
    }
}
