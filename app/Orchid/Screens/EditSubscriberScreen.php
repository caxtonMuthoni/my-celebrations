<?php

namespace App\Orchid\Screens;

use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditSubscriberScreen extends Screen
{
    protected $exists = false;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Subscriber $subscriber): iterable
    {
        $this->exists = $subscriber->exists;
        return [
            'subscriber' => $subscriber
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
            return 'Edit subscriber';
        }

        return "Adding new subscriber";
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
                Relation::make('subscriber.user_id')->fromModel(User::class, 'name')->title('Subscribing User'),
                Relation::make('subscriber.subscription_plan_id')->fromModel(SubscriptionPlan::class, 'name')->title('Subscription Plan'),
                CheckBox::make('subscriber.is_active')
                    ->sendTrueOrFalse()
                    ->title('Subscription status')
                    ->placeholder('Is the subscription active')
                    ->help('Check to make sure the subscription is active')
            ])
        ];
    }

    public function createOrUpdate(Subscriber $subscriber, Request $request)
    {
        $subscriberData = $request->get('subscriber');
        $subscriber->user_id = $subscriberData['user_id'];
        $subscriber->subscription_plan_id = $subscriberData['subscription_plan_id'];
        $subscriber->is_active = $subscriberData['is_active'];
        $subscriber->save();

        Alert::success('The subscriber was uploaded successfully');
        return redirect()->route('platform.dashboard.subscription');
    }


    public function remove(Subscriber $subscriber)
    {
        if ($subscriber->delete()) {
            Alert::success('The subscriber was deleted successfully');
            return redirect()->route('platform.dashboard.subscription');
        }
    }
}
