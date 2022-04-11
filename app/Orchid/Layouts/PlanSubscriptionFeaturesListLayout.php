<?php

namespace App\Orchid\Layouts;

use App\Models\SubscriptionFeature;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PlanSubscriptionFeaturesListLayout extends Table
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
            TD::make('', 'Select Feature')
                ->render(function (SubscriptionFeature $subscriptionFeature) {
                    $selectedFeature = $this->query->get('selected')->where('subscription_feature_id', $subscriptionFeature->id)->first();
                    return CheckBox::make('features[]')
                        ->value($subscriptionFeature->id)
                        ->placeholder($subscriptionFeature->name)
                        ->checked(isset($selectedFeature));
                }),
            // TD::make('name', 'Feature Name'),
            TD::make('description', 'Feature Description'),
            TD::make('', 'Remove')
                ->render(function (SubscriptionFeature $feature) {
                    return Button::make()
                        ->icon('trash')
                        ->class('btn text-danger')
                        ->method('removeSubPlanFeature', [$feature]);
                }),
        ];
    }
}
