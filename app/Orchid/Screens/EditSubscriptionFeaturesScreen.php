<?php

namespace App\Orchid\Screens;

use App\Models\SubscriptionFeature;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditSubscriptionFeaturesScreen extends Screen
{
    protected $exists =  false;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(SubscriptionFeature $subscriptionFeature): iterable
    {
        $this->exists = $subscriptionFeature->exists;
        return [
            "feature" => $subscriptionFeature
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        if ($this->exists) {
            return 'Edit subscription feature';
        }

        return "Adding new subscription feature";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('createOrUpdate')
                ->class('btn btn-success')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->class('btn btn-danger')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('feature.name')->type('text')->title('Subscription feature name')->help('What is the feature\'s title? '),
                TextArea::make('feature.description')->type('text')
                    ->title('Subscription feature description')->help('Tell us more about the feature? ')
                    ->rows(8),
            ])
        ];
    }

    public function createOrUpdate(SubscriptionFeature $subscriptionFeature, Request $request)
    {
        $featureData = $request->get('feature');
        $subscriptionFeature->name = $featureData['name'];
        $subscriptionFeature->description = $featureData['description'];
        $subscriptionFeature->save();

        Alert::success('The subscription feature was uploaded successfully');
        return redirect()->route('platform.dashboard.subscription-features');
    }


    public function remove(SubscriptionFeature $subscriptionFeature)
    {
        if ($subscriptionFeature->delete()) {
            Alert::success('The subscription feature was deleted successfully');
            return redirect()->route('platform.dashboard.subscription-features');
        }
    }
}
