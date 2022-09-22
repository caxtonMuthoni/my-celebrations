@extends('layouts.home')
@section('content')
<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="home-info">
                    <h1>Create books from multiple categories</h1>
                    <p class="text-white">
                        You can create your book from multiple categories. See the list below
                    </p>
                    <a href="#about" class="btn section-btn smoothScroll">Join US For Free!</a>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="home-video about_image">
                    <img class="about_image--img" src="{{asset('images/shared/pineapple.png')}}" alt="">
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
                    <h2>Available categories</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            <div class="col-md-12 row justify-content-center">
                @foreach($categories as $category)
                <div class="col-md-3">
                   <div class="card shadow">
                    <div class="category-img-container">
                    <img src="{{$category->image}}" class="card-img-top category-img" style="width: 100%;" alt="...">
                    </div>
                     <div class="card-body">
                       <h5 class="card-title">{{$category->name}}</h5>
                     </div>
                   </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection