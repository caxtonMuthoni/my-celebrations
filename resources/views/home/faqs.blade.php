@extends('layouts.home')
@section('content')
<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="home-info">
                    <h1>Frequently Asked Questions</h1>
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
                    <img src="{{asset('images/faqs.png')}}" alt="">
                </div>
            </div>

        </div>
    </div>
</section>


<!-- WORK -->
<section id="work" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row mb-5">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>FAQs</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            @foreach($faqs as $key=>$faq)
            <div class="col-md-10 border-tab">
                <p>
                <div class=" p-2" data-toggle="collapse" href="#collapseExample-{{$key}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                   {{$faq['question']}}
                </div>

                </p>
                <div class="collapse" id="collapseExample-{{$key}}">
                    <div class="card card-body">
                    {{$faq['answer']}}
                    </div>
                </div>
            </div>
            @endforeach




        </div>
    </div>
</section>

@endsection