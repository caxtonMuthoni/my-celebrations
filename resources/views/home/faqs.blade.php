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
                    <img src="{{asset('images/branding/logo.jpeg')}}" alt="">
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

            <div class="col-md-10 border-tab">
                <p>
                <div class=" p-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    How many books can create per day ?
                </div>

                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </div>
                </div>
            </div>

            <div class="col-md-10 border-tab">
                <p>
                <div class=" p-2" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Will my books be deleted ?
                </div>

                </p>
                <div class="collapse" id="collapseExample2">
                    <div class="card card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero sapiente libero nihil minus consequuntur,
                         eum facere dolores, quae provident nulla ad a non dolor culpa deleniti voluptatem reiciendis iusto 
                         officia. Temporibus vel quia architecto a ab atque omnis autem cumque itaque voluptatum ea amet 
                         ipsum voluptatibus et reiciendis molestiae dolor error iure, commodi sunt blanditiis delectus, 
                         mollitia pariatur! Excepturi accusantium laudantium porro eos unde atque vel quas soluta ratione. 
                         Et facilis ullam, vero quaerat fugit dolores libero laborum. Rem corrupti eius unde odit. 
                         Perspiciatis
                         laudantium dicta explicabo non fugit illum quae fuga aut nemo, quasi nostrum beatae soluta magni eos!
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>

@endsection