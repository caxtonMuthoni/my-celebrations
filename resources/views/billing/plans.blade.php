@extends('layouts.app')
@section('content')
<div class="billing-plan container">
    <div class="container row justify-content-center">
        <div class="col-md-10 text-center">
            @can('hasPlan')
            <h4 class="heading">Your current subscription plan</h4>
            @else
            <h4 class="heading">Choose subscription plan</h4>
            @endcan
        </div>
        @foreach($plans as $plan)
        <div class="col-md-4 mt-3">
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
                        <div class="billing-plan__content--description">Up to {{$plan->available_templates}} templates</div>
                    </div>

                    <div class="billing-plan__content--item">
                        <div class="billing-plan__content--icon">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="billing-plan__content--description">Up to {{$plan->messages_per_book}} book messages</div>
                    </div>

                    <div class="billing-plan__content--item">
                        <div class="billing-plan__content--icon">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="billing-plan__content--description">Up to {{$plan->pictures_per_book}} book pictures</div>
                    </div>

                    @if($plan->can_tranfer_book)
                    <div class="billing-plan__content--item">
                        <div class="billing-plan__content--icon">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="billing-plan__content--description">Book transfer to other users.</div>
                    </div>
                    @endif

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
                        {{ $plan->cost }} <span class="billing-plan__cta--amount--period"> USD
                        </span>
                    </div>
                    <div class="billing-plan__cta--btn">
                        @can('hasPlan')
                        <a href="{{route('book-create')}}" class="btn btn__primary">Create Book</a>
                        @else
                        <a href="{{route('billing-payments', $plan->id)}}" class="btn btn__primary">Choose Plan</a>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
</div>
@endsection