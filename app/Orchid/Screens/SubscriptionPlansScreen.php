<?php

namespace App\Orchid\Screens;

use App\Models\SubscriptionPlan;
use App\Orchid\Layouts\SubscriptionPlansListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SubscriptionPlansScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'plans' => SubscriptionPlan::all(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'System Subscription Plans';
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
            ->route('platform.dashboard.subscription-plans-edit')
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
            SubscriptionPlansListLayout::class
        ];
    }
}
