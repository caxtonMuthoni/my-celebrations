@extends('layouts.app')
@section('content')
<div class="billing-payment container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-3">
            <h4 class="heading">Completed your MPESA transaction</h4>
        </div>
        <div class="col-md-6">
            <div class="card billing-payment__card p-5 shadow-sm">
                <img src="{{asset('images/payments/mpesa.png')}}" alt="" class="billing-payment__img">
                <div class="billing-payment__type">Enter your MPESA PIN in your phone</div>
                <div class="alert alert-info mt-2">
                    Dear customer, a pop up was sent to your phone number requesting you to input your MPESA pin number.
                    Kindly enter your pin to complete the transcaction. <br>

                   <strong> Once the transaction is complete, click the button below to comfirm the transaction.</strong>
                </div>

                <div class="text-center">
                    <a href="{{route('billing-mpesa-confirm', $id)}}" class="btn btn btn__primary">Confirm Transaction</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection