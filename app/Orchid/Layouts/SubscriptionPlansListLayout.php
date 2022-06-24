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
            // TD::make('description', 'Description'),
            TD::make('convertion_rate', 'Convertion rate'),
            TD::make('cost', 'Total Cost(USD)'),
            TD::make('cost', 'Total cost(KES)')->render(function($plan) {
                return $plan->cost * $plan->convertion_rate;
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
