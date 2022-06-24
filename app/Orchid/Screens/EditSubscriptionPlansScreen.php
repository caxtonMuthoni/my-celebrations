<?php

namespace App\Orchid\Screens;

use App\Models\SubscriptionFeature;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanFeatures;
use App\Orchid\Layouts\PlanSubscriptionFeaturesListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditSubscriptionPlansScreen extends Screen
{
    protected $exists = false;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(SubscriptionPlan $subscriptionPlan): iterable
    {
        $this->exists = $subscriptionPlan->exists;
        return [
            "plan" => $subscriptionPlan,
            "selected" => $subscriptionPlan->features,
            "features" => SubscriptionFeature::all(),
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
            return 'Edit subscription plan';
        }

        return "Adding new subscription plan";
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
            Layout::columns([
                Layout::rows([
                    Input::make('plan.name')->type('text')->title('Subscription plan name')->help('What is the plan\'s title? '),
                    TextArea::make('plan.description')->type('text')
                        ->title('Subscription plan description')->help('Tell us more about the plan? ')
                        ->rows(2),
                    Input::make('plan.messages_per_book')->type('text')->title('Messages per book')->help('What is the plan\'s maximum messages per book? '),
                    Input::make('plan.pictures_per_book')->type('text')->title('Pictures per book')->help('What is the plan\'s maximum number of pictures per book? '),
                ]),

                Layout::rows([
                    Input::make('plan.available_templates')->type('text')->title('Available templates')->help('What is the plan\'s maximum number of templates available? '),
                    Input::make('plan.cost')->type('text')->title('Subscription plan cost id USD')->help('What is the plan\'s total cost in USD? '),
                    Input::make('plan.convertion_rate')->type('text')->title('Convertion rate for USD to KES')->help('What is the convertion rate the system uses to convert price from USD to KES? '),
                    CheckBox::make('plan.can_tranfer_book')
                        ->title('Can the user tranfer the book to other users ?')
                        ->placeholder('Will the users be able to transfer the book to other users?')
                        ->sendTrueOrFalse(),
                    Input::make('plan.id')->hidden()
                ])
            ]),

            PlanSubscriptionFeaturesListLayout::class

        ];
    }

    public function createOrUpdate(SubscriptionPlan $subscriptionPlan, Request $request)
    {
        $featureData = $request->get('features');
        $planData = $request->get('plan');
        $subscriptionPlan->name = $planData['name'];
        $subscriptionPlan->description = $planData['description'];
        // $subscriptionPlan->days_to_expiry = $planData['days_to_expiry'];
        // $subscriptionPlan->total_number_books = $planData['total_number_books'];
        $subscriptionPlan->messages_per_book = $planData['messages_per_book'];
        $subscriptionPlan->pictures_per_book = $planData['pictures_per_book'];
        $subscriptionPlan->available_templates = $planData['available_templates'];
        $subscriptionPlan->convertion_rate = $planData['convertion_rate'];
        $subscriptionPlan->can_tranfer_book = $planData['can_tranfer_book'];
        $subscriptionPlan->cost = $planData['cost'];
        if ($subscriptionPlan->save()) {
            $subscriptionPlan = $subscriptionPlan->refresh();
            foreach ($featureData as $id) {
                $subPlanFeature = SubscriptionPlanFeatures::where([['subscription_feature_id', $id], ['subscription_plan_id', $subscriptionPlan->id]])->first();
                if (!isset($subPlanFeature)) {
                    $subPlanFeature = new SubscriptionPlanFeatures();
                }
                $subPlanFeature->subscription_feature_id = $id;
                $subPlanFeature->subscription_plan_id = $subscriptionPlan->id;
                $subPlanFeature->save();
            }
        }

        Alert::success('The subscription plan was uploaded successfully');
        return redirect()->route('platform.dashboard.subscription-plans');
    }


    public function remove(SubscriptionPlan $subscriptionPlan)
    {
        if ($subscriptionPlan->delete()) {
            Alert::success('The subscription plan was deleted successfully');
            return redirect()->route('platform.dashboard.subscription-plans');
        }
    }

    public function removeSubPlanFeature(SubscriptionFeature $feature, Request $request)
    {
        $planId = $request->get('plan')['id'];
        $subPlanFeature = SubscriptionPlanFeatures::where([['subscription_feature_id', $feature->id], ['subscription_plan_id', $planId]])->first();
        if (isset($subPlanFeature)) {
            $subPlanFeature->delete();
            Alert::success('The subscription plan feature was removed successfully');
            return redirect()->route('platform.dashboard.subscription-plans-edit', $planId);
        }
    }
}
