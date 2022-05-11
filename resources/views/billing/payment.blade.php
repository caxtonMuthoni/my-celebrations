@extends('layouts.app')
@section('content')
<div class="billing-payment container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-3">
            <h4 class="heading">Select your payment method</h4>
        </div>
        <div class="col-md-4">
            <a href="{{route('billing-mpesa', $id)}}" class="card billing-payment__card p-5 shadow-sm">
                <img src="{{asset('images/payments/mpesa.png')}}" alt="" class="billing-payment__img">
                <div class="billing-payment__type">MPESA</div>
            </a>
        </div>

        <!-- <div class="col-md-4">
            <div class="card billing-payment__card p-5 shadow-sm">
                <img src="{{asset('images/payments/visa.png')}}" alt="" class="billing-payment__img">
                <div class="billing-payment__type">VISA & MASTER CARD</div>
            </div>
        </div> -->

        <div class="col-md-4">
            <a href="{{route('billing-paypal-view', $id)}}" class="card billing-payment__card p-5 shadow-sm">
                <img src="{{asset('images/payments/paypal.png')}}" alt="" class="billing-payment__img">
                <div class="billing-payment__type">PAYPAL & CARDS</div>
            </a>
        </div>
    </div>
</div>
@endsection