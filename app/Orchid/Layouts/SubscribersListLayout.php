<?php

namespace App\Orchid\Layouts;

use App\Helpers\DateFormatter;
use App\Models\Subscriber;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SubscribersListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'subscribers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('user_id', 'User')->render(function(Subscriber $subscriber) {
                return $subscriber->user->name;
            }),
            TD::make('user_id', 'Subscription Plan')->render(function(Subscriber $subscriber) {
                return $subscriber->subscriptionPlan->name;
            }),
            TD::make('is_active', 'Status')->render(function(Subscriber $subscriber) {
                if($subscriber->is_active) {
                    return '<div class="badge bg-success">Active</div>';
                }
                return '<div class="badge bg-danger">Expired</div>';
            }),
            
            TD::make('created_at', 'Created')->render(function (Subscriber $subscriber) {
                $createdAt = Carbon::parse($subscriber->created_at);
                return $createdAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('updated_at', 'Last edit')->render(function (Subscriber $subscriber) {
                $updatedAt = Carbon::parse($subscriber->updated_at);
                return $updatedAt->format(DateFormatter::defaultDateFormat());
            }),
            TD::make('', 'Action')
                ->render(function (Subscriber $subscriber) {
                    return Link::make()
                        ->icon('pencil')
                        ->class('text-primary')
                        ->route('platform.dashboard.subscription-edit', $subscriber);
                }),
        ];
    }
}
