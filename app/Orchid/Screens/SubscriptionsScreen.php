<?php

namespace App\Orchid\Screens;

use App\Models\Subscriber;
use App\Orchid\Layouts\SubscribersListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SubscriptionsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'subscribers' => Subscriber::all(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Subscribers';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('New subscription plan')
            ->icon('note')
            ->route('platform.dashboard.subscription-edit')
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
            SubscribersListLayout::class
        ];
    }
}
