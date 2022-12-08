@extends ('layouts.welcome')
@section ('content')
<header class="about__header">
   <h2 class="heading heading__3">Categories</h2>
   <p class="about__header--paragraph">You can create your book from multiple categories. See the list below</p>
</header>
<div class="categories">
   <div class="dos__container">
      <h2 class="heading heading__2">Book Categories</h2>
      <p class="heading__description">Create books from multiple categories</p>
   </div>
   <div class="categories__list">
      @foreach($categories as $category)
      <div class="features__feature shadow_card">
         <div class="features__feature--img">
            <img class="features__feature--photo" src="{{$category->image}}" alt="">
         </div>
         <div class="features__feature--content">
            <h4 class="heading heading__4 features__feature--title">{{$category->name}} category</h4>
         </div>
      </div>
      @endforeach
   </div>
</div>
@include('includes.contact')
@endsection