@extends ('layouts.welcome')
@section ('content')
<header class="about__header">
   <h2 class="heading heading__3">Plans</h2>
   <p class="about__header--paragraph">This is an online platform that allows people to capture and save special memories.</p>
</header>

<section class="plans">
   <div class="dos__container">
      <h2 class="heading heading__2">Our Plans</h2>
      <p class="heading__description">Our plans are affordable; choose your best plan</p>
   </div>
   <div class="plans__list">
      @foreach($plans as $plan)
      <div class="plans__plan">
         <div class="plans__plan--title">
            <h3 class="heading heading__3"> {{$plan->name}}</h3>
         </div>
         <ul class="plans__plan--features">
            <li class="plans__plan--feature">Up to {{$plan->available_templates}} templates</li>
            <li class="plans__plan--feature">Up to {{$plan->messages_per_book}} book messages</li>
            <li class="plans__plan--feature">Up to {{$plan->pictures_per_book}} book pictures</li>
            @if($plan->can_tranfer_book)
            <li class="plans__plan--feature">Book transfer to other users.</li>
            @endif
            @foreach($plan->features as $feature)
            <li class="plans__plan--feature">{{$feature->featureDetails?->description}}</li>
            @endforeach
         </ul>
         <div class="plans__plan--pricing">
            <h4 class="heading heading__4">${{ $plan->cost }} / book</h4>
         </div>
         <div class="plans__plan--cta">
            <a href="{{route('billing-payments', $plan->id)}}" class="btn btn__rounded">Get Started</a>
         </div>
      </div>
      @endforeach
   </div>
</section>

@include('includes.contact')
@endsection