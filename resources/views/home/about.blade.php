@extends('layouts.home')
@section('content')
<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="home-info">
                    <h1>About US ?</h1>
                    <p class="text-white">
                        My celebrations book is a service from Broaden Reach Online Services (BROS), an E-Commerce company committed to providing online solutions to every day needs. Our vision to be a globally recognized brand in digital document creation services. We stand for honesty, timeliness, efficiency, customer focus and integrity in our services to you, our customer. Welcome onboard, enjoy the ride.
                    </p>
                    <a href="#about" class="btn section-btn smoothScroll">Join US For Free!</a>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="home-video">
                    <img src="{{asset('images/about.png')}}" alt="">
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ABOUT -->
<section id="about" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-6 col-sm-6">
                <div class="about-info">
                    <div class="section-title">
                        <h2>Meet The CEO Founder</h2>
                        <span class="line-bar">...</span>
                    </div>
                    <p>We live our lives story by story through the memories we create.
                        While it is important to preserve our most cherished memories, the human mind
                        cannot remember forever. My celebrations book is now giving you an opportunity to capture, keep and share your happy moments in an online storage. </p>
                    <p>
                        From baby showers, to child naming ceremonies, rites of passage, birthdays, baptism, weddings, graduations, anniversaries, award ceremonies, trips, holidays and more, we shall help you keep your treasured memories safe.
                    </p>
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="about-image">
                    <img src="images/about-image.png" class="img-responsive" alt="">
                </div>
            </div>

        </div>
    </div>
</section>

<section>
<div class="my-5 py-5">&nbsp;</div>
</section>



<!-- WORK -->
@endsection