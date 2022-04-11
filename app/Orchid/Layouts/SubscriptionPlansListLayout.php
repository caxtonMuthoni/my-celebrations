<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SubscriptionPlansListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'plans';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Name'),
            TD::make('description', 'Description'),
            TD::make('days_to_expiry', 'Period(Days)'),
            TD::make('total_number_books', 'Books'),
            TD::make('cost', 'Total cost(KES)'),
            TD::make('created_at', 'Created')->render(function (SubscriptionPlan $subscriptionPlan) {
                $createdAt = Carbon::parse($subscriptionPlan->created_at);
                return $createdAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('updated_at', 'Last edit')->render(function (SubscriptionPlan $subscriptionPlan) {
                $updatedAt = Carbon::parse($subscriptionPlan->updated_at);
                return $updatedAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('', 'Action')
                ->render(function (SubscriptionPlan $subscriptionPlan) {
                    return Link::make()
                        ->icon('pencil')
                        ->class('text-primary')
                        ->route('platform.dashboard.subscription-plans-edit', $subscriptionPlan);
                }),
        ];
    }
}
