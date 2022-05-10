<?php

namespace App\Http\Controllers;

use App\Helpers\PhoneSanitizer;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Payment\MpesaSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function plans()
    {
        $plans = SubscriptionPlan::with('features.featureDetails')->get();
        return view('billing.plans', compact('plans'));
    }

    public function payments($id)
    {
        return view('billing.payment', compact('id'));
    }

    public function mpesaView($id)
    {
        $plan = SubscriptionPlan::find($id);
        return view('billing.mpesa', compact('plan'));
    }

    public function payWithMpesa(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required | string | min:10 | max:10'
        ]);

        try {

            $mpesaSubscription = new MpesaSubscription();
            $plan = SubscriptionPlan::find($request->plan_id);
            $amount = $plan->cost;
            $phoneNumber = substr(PhoneSanitizer::sanitize($request->phone_number), 1);
            $response = $mpesaSubscription->stkPush($phoneNumber, $amount);
            $merchantId = property_exists($response, 'MerchantRequestID');

            if ($merchantId) {
                $id = $response->MerchantRequestID;
                $transaction = new Transaction();
                $transaction->MerchantRequestID = $id;
                $transaction->CheckoutRequestID = $response->CheckoutRequestID;
                $transaction->subscription_plan_id = $plan->id;
                $transaction->amount = $amount;
                $transaction->user_id = Auth::id();
                $transaction->transaction_id = 'MPESATID';
                $transaction->type = 'MPESA';
                $transaction->save();
                return redirect()->route('billing-mpesapopup', compact('id'));
            }

            return redirect()->back()->with('error', 'The process failed, Please try again');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'The process failed, Please try again');
        }
    }

    public function mpesaPopUp($id)
    {
        return view('billing.mpesapopup', compact('id'));
    }

    public function mpesaConfirmTransaction($id)
    {
        $trascationComplete = Transaction::where('MerchantRequestID', $id)->value('is_complete');
        if ($trascationComplete) {
            return redirect()->route('home')->with('success', 'The trasaction was completed successfully.');
        }

        return redirect()->back()->with('error', 'The transaction is yet to be completed, please wait for a few minutes.');
    }
}

// { "MerchantRequestID":"98422-37744695-1", "CheckoutRequestID":"ws_CO_10052022120347811743751575", "ResponseCode": "0", "ResponseDescription":"Success. Request accepted for processing", "CustomerMessage":"Success. Request accepted for processing" }