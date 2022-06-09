<?php

namespace App\Helpers;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class TemplatesNumberGetter
{

    public static function getNumberOfTemplates()
    {
        $userSubscription = Subscriber::with('subscriptionPlan')->where([['user_id', Auth::id()], ['is_active', true]])->first();
        $userSubscriptionName = $userSubscription->subscriptionPlan->name;

        if (isset($userSubscription) && isset($userSubscriptionName)) {
            $userSubscriptionName = strtolower($userSubscriptionName);
            switch ($userSubscriptionName) {
                case 'bronze':
                    return 5;
                case 'gold':
                    return 10;
                case 'platinum':
                    return 20;
                default:
                    return 5;
            }
        }

        return 5;
    }
}
