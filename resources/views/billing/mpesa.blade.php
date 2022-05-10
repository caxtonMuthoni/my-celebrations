@extends('layouts.app')
@section('content')
<div class="billing-payment container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-3">
            <h4 class="heading">Pay for this plan using MPESA</h4>
        </div>
        <div class="col-md-6">
            <div class="card billing-payment__card p-5 shadow-sm">
                <img src="{{asset('images/payments/mpesa.png')}}" alt="" class="billing-payment__img">
                <div class="billing-payment__type">Pay KSH {{$plan->cost}} for plan {{$plan->name}}.</div>
                <form action="{{route('billing-with-mpesa')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Enter your payment phone number</label>
                        <input type="text" class="form-control form-control-lg" name="phone_number" id="phone_number" aria-describedby="phone" placeholder="eg . 0712XXXXXX">
                        <small id="phone" class="form-text text-muted">Provide the mpesa number you wish to complete this transaction with.</small>
                    </div>

                    <input type="text" value="{{$plan->id}}" name="plan_id" hidden>

                    <div class="text-right">
                        <button type="submit" class="btn btn__primary">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection