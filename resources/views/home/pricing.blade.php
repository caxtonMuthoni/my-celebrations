@extends('layouts.home')
@section('content')
<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="home-info">
                    <h1>Our plans are affordable</h1>
                    <p class="text-white">
                        This is an online platform that allows people to capture and
                        save special memories.
                    </p>
                    <a href="#about" class="btn section-btn smoothScroll">Join US For Free!</a>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="home-video">
                    <img src="{{asset('images/plans.png')}}" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- WORK -->
<section id="work" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Choose your best plan</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            <div class="col-md-10 row justify-content-center">
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
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                </div>
                                <div style="font-size: 13px;" class="billing-plan__content--description">Up to {{$plan->available_templates}} templates</div>
                            </div>

                            <div class="billing-plan__content--item">
                                <div class="billing-plan__content--icon">
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                </div>
                                <div style="font-size: 13px;" class="billing-plan__content--description">Up to {{$plan->messages_per_book}} book messages</div>
                            </div>

                            <div class="billing-plan__content--item">
                                <div class="billing-plan__content--icon">
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                </div>
                                <div style="font-size: 13px;" class="billing-plan__content--description">Up to {{$plan->pictures_per_book}} book pictures</div>
                            </div>

                            @if($plan->can_tranfer_book)
                            <div class="billing-plan__content--item">
                                <div class="billing-plan__content--icon">
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                </div>
                                <div style="font-size: 13px;" class="billing-plan__content--description">Book transfer to other users.</div>
                            </div>
                            @endif

                            @foreach($plan->features as $feature)
                            <div class="billing-plan__content--item">
                                <div class="billing-plan__content--icon">
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                </div>
                                <div style="font-size: 13px;" class="billing-plan__content--description">{{$feature->featureDetails?->description}}</div>
                            </div>
                            @endforeach
                        </div>
                        <div class="billing-plan__cta">
                            <div class="billing-plan__cta--amount">
                               ${{ $plan->cost }} <span class="billing-plan__cta--amount--period"> / book
                                </span>
                            </div>
                            <div class="billing-plan__cta--btn">
                                <a href="{{route('billing-payments', $plan->id)}}" class="btn btn-primary">Choose Plan</a>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection