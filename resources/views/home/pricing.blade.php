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
                    <img src="{{asset('images/branding/logo.jpeg')}}" alt="">
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

            <div class="col-md-10">
                No Plans Yet
            </div>
        </div>
    </div>
</section>

@endsection