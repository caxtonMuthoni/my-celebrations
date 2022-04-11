<?php

namespace App\Orchid\Screens;

use App\Models\SubscriptionFeature;
use App\Orchid\Layouts\SubscriptionFeaturesListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SubscriptionFeaturesScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'features' => SubscriptionFeature::all(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'System Subscription Features';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('New subscription feature')
            ->icon('note')
            ->route('platform.dashboard.subscription-features-edit')
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
            SubscriptionFeaturesListLayout::class
        ];
    }
}
