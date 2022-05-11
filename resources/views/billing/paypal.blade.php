@extends('layouts.app')
@section('content')
<div class="billing-payment container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-3">
            <h4 class="heading">Pay with PAYPAL or CREDIT/DEBIT Cards</h4>
        </div>
    
        <div class="col-md-6">
            <div class="card billing-payment__card p-5 shadow-sm">
                <img src="{{asset('images/payments/paypal.png')}}" alt="" class="billing-payment__img">
                <div class="billing-payment__type">Subscribe to {{$plan->name}} plan @ KSH {{$plan->cost}}</div>
                <paypal-component :plan="{{$plan}}" />
            </div>
        </div>
    </div>
</div>
@endsection