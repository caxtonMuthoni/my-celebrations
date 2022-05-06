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
                        save special memories. From celebrations to holidays and special days such as weddings, father’s day, mother’s day and parties,
                        we allow you to publish a story and upload photos to help you remember each event.
                    </p>
                    <a href="#about" class="btn section-btn smoothScroll">Join US For Free!</a>
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="home-video">
                    <img src="{{asset('images/branding/logo.jpeg')}}" alt="">
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
                    <img src="images/about-image.jpg" class="img-responsive" alt="">
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
                    <h2>Meet our team</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- WORK THUMB -->
                <div class="work-thumb">
                    <a href="{{asset('images/team/john.jpg')}}" class="image-popup">
                        <img src="{{asset('images/team/john.jpg')}}" class="img-responsive" alt="Work">

                        <div class="work-info">
                            <h3>John Doe</h3>
                            <small>CEO, Founder</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- WORK THUMB -->
                <div class="work-thumb">
                    <a href="{{asset('images/team/mary.jpg')}}" class="image-popup">
                        <img src="{{asset('images/team/mary.jpg')}}" class="img-responsive" alt="Work">

                        <div class="work-info">
                            <h3>Mary Doe</h3>
                            <small>Marketing Manager</small>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- WORK THUMB -->
                <div class="work-thumb">
                    <a href="{{asset('images/team/elvis.jpg')}}" class="image-popup">
                        <img src="{{asset('images/team/elvis.jpg')}}" class="img-responsive" alt="Work">

                        <div class="work-info">
                            <h3>Elvis Doe</h3>
                            <small>CTO, Manager</small>
                        </div>
                    </a>
                </div>
            </div>


            <div class="col-md-3 col-sm-6">
                <!-- WORK THUMB -->
                <div class="work-thumb">
                    <a href="{{asset('images/team/jane.jpg')}}" class="image-popup">
                        <img src="{{asset('images/team/jane.jpg')}}" class="img-responsive" alt="Work">

                        <div class="work-info">
                            <h3>Jane Doe</h3>
                            <small>Art, Design</small>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection