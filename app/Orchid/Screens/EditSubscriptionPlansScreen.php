<?php

namespace App\Orchid\Screens;

use App\Models\SubscriptionFeature;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanFeatures;
use App\Orchid\Layouts\PlanSubscriptionFeaturesListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
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
                        ->rows(7),
                ]),

                Layout::rows([
                    Input::make('plan.days_to_expiry')->type('text')->title('Subscription plan active days')->help('What is the plan\'s total active days? '),
                    Input::make('plan.cost')->type('text')->title('Subscription plan cost')->help('What is the plan\'s total cost? '),
                    Input::make('plan.total_number_books')->type('text')->title('Subscription plan total books')->help('What is the plan\'s total books? '),
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
        $subscriptionPlan->days_to_expiry = $planData['days_to_expiry'];
        $subscriptionPlan->total_number_books = $planData['total_number_books'];
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
        if(isset($subPlanFeature)) {
            $subPlanFeature->delete();
            Alert::success('The subscription plan feature was removed successfully');
            return redirect()->route('platform.dashboard.subscription-plans-edit', $planId);
        }
    }
}
