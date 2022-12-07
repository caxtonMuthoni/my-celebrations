@extends ('layouts.welcome')
@section ('content')
<header class="about__header">
   <h3 class="heading heading__3">FAQs</h3>
   <p class="about__header--paragraph">This is an online platform that allows people to capture and save special memories. From celebrations to holidays and special days such as weddings, father’s day, mother’s day and parties, we allow you to publish a story and upload photos to help you remember each event.</p>
</header>
<div class="faqs">
   <div class="dos__container">
      <h2 class="heading heading__2">Frequently Asked Questions</h2>
      <p class="heading__description">Have a question ?</p>
   </div>
   <div class="faqs__list">
      @foreach($faqs as $key=>$faq)
      <button class="faqs__accordion">
         <span>{{$faq['question']}}</span>
      </button>
      <div class="faqs__panel">
         <p>{{$faq['answer']}}</p>
      </div>
      @endforeach
   </div>
</div>
@include('includes.contact')
@endsection