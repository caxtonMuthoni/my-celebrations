<?php

namespace App\Payment;

use App\Models\Subscriber;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Facades\PayPal;

class PaypalSubscription
{

  public function addPayPalSubscription(Request $request)
  {

    $plan = SubscriptionPlan::find($request->plan_id);

    $transaction = new Transaction();
    $transaction->MerchantRequestID = 'PAYPAL_MARCHANT';
    $transaction->CheckoutRequestID =  $request->order_id;
    $transaction->subscription_plan_id = $plan->id;
    $transaction->amount = $plan->cost;
    $transaction->user_id = Auth::id();
    $transaction->is_complete = true;
    $transaction->result = $request->status;
    $transaction->transaction_id = $request->order_id;
    $transaction->type = 'PAYPAL';
    if ($transaction->save()) {
      $transaction = $transaction->refresh();
      $subscriber = new Subscriber();
      $subscriber->user_id = $transaction->user_id;
      $subscriber->subscription_plan_id = $transaction->subscription_plan_id;
      $subscriber->is_active = true;
      if($subscriber->save()) {
        return response()->json([
          'status' => true,
          'message' => 'Subscription was added successfully.'
        ]);
      }
    }

    return response()->json([
      'status' => false,
      'message' => 'Oops ! the subscription has failed'
    ]);
  }
}
