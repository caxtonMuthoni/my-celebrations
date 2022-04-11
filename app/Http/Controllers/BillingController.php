<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function plans() {
        $plans = SubscriptionPlan::with('features.featureDetails')->get();
        return view('billing.plans', compact('plans'));
    }

    public function payments($id) {
        return view('billing.payment');
    }
}
