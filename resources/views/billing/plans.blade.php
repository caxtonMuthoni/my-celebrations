@extends('layouts.app')
@section('content')
<div class="billing-plan container">
    <div class="container row justify-content-center">
        <div class="col-md-10 text-center">
            <h4 class="heading">Choose subscription plan</h4>
        </div>
        @foreach($plans as $plan)
        <div class="col-md-3 mt-3">
            <div class="billing-plan__card shadow-sm">
                <div class="billing-plan__header">
                    <div class="billing-plan__header--icon shadow-sm">
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    </div>
                    <div class="billing-plan__header--title">
                        {{$plan->name}}
                    </div>
                </div>
                <div class="billing-plan__content">
                    <div class="billing-plan__content--item">
                        <div class="billing-plan__content--icon">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="billing-plan__content--description">Up to {{$plan->total_number_books}} books</div>
                    </div>
                    @foreach($plan->features as $feature)
                    <div class="billing-plan__content--item">
                        <div class="billing-plan__content--icon">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="billing-plan__content--description">{{$feature->featureDetails?->description}}</div>
                    </div>
                    @endforeach
                </div>
                <div class="billing-plan__cta">
                    <div class="billing-plan__cta--amount">
                        KSH {{ $plan->cost }} <span class="billing-plan__cta--amount--period">/ {{ $plan->days_to_expiry }} day
                            @if($plan->days_to_expiry > 1)
                            s
                            @endif

                        </span>
                    </div>
                    <div class="billing-plan__cta--btn">
                        <a href="{{route('billing-payments', $plan->id)}}" class="btn btn__primary">Choose Plan</a>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
</div>
@endsection