@extends('layouts.home')
@section('content')
<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay particles-js" id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="home-info">
                    <h1 class="text-white">My Celebrations Book, where memories never fail</h1>
                    <p class="text-white">
                        We live our lives story by story through the memories we create.
                        While it is important to preserve our most cherished memories,
                        the human mind is limited. My celebrations book is now giving you an opportunity to capture,
                        keep and share your happy moments in an online storage. From baby showers, to child naming ceremonies,
                        rites of passage, birthdays, baptism, weddings, graduations, anniversaries,
                        award ceremonies, trips, holidays and more, we shall help you keep your treasured memories safe.
                    </p>
                    <a href="{{route('book-create')}}" class="btn section-btn smoothScroll">Create new book</a>
                    <span>
                        CALL US +254768069134, +254738121484
                        <small>For any inquiry</small>
                    </span>
                </div>
            </div>

            <div class="col-md-5 col-sm-12">
                <div class="home-video about_image">
                    <img class="about_image--img" src="{{asset('images/shared/wedding.png')}}" alt="">
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ABOUT -->
<section id="about" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-5 col-sm-6">
                <div class="about-info">
                    <div class="section-title">
                        <h2>What you can do </h2>
                        <span class="line-bar">...</span>
                    </div>
                    <p> My celebrations book has created a platform for you to capture your special moments forever. This will help you to </p>
                    <p>
                        1. Record your memories of each event <br>
                        2. Upload the most important pictures <br>
                        3. Invite others contribute to your story by sending messages such as
                        birthday wishes, congratulations for wedding, graduations etc. They can also share photos alongside the messages <br>
                        4. Download or print the book for a different form of storage or other uses.

                    </p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="about-info">
                    <div class="section-title">
                        <h4>Why you need to write down your memories</h4>
                        <!-- <span class="line-bar">...</span> -->
                    </div>
                    <ul class="px-0 mx-0" style="padding: 0;">
                        <ol class="px-0 mx-0" style="padding: 0;">
                            <p> 1. Establish a tradition of recording important events such as birthdays,
                                wedding and anniversaries, graduation etc; all in one safe account!</p>
                        </ol>
                        <ol style="padding: 0;">
                            <p>2. Re-live your good times and the messages from loved ones.</p>
                        </ol>
                        <ol style="padding: 0;">
                            <p>3. Affordably keep your happy moments safe</p>
                        </ol>
                        <!-- <ol style="padding: 0;">
                            <p>4. Affordably keep your happy moments safe</p>
                        </ol>
                        <ol style="padding: 0;">
                            <p>5. Travel in time</p>
                        </ol> -->
                    </ul>
                </div>
                <!-- <div class="about-info skill-thumb">

                        <strong>Web Design</strong>
                        <span class="pull-right">85%</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                        </div>

                        <strong>Photography</strong>
                        <span class="pull-right">90%</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                        </div>

                        <strong>Content Marketing</strong>
                        <span class="pull-right">75%</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                        </div>

                        <strong>CMS Admin</strong>
                        <span class="pull-right">70%</span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                        </div>

                    </div> -->
            </div>

            <div class="col-md-3 col-sm-12">
                <div class="about-image">
                    <img src="images/shared/happy-woman.png" class="img-responsive" alt="">
                </div>
            </div>

        </div>
    </div>
</section>


<!-- BLOG -->
<section id="blog" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Our Features</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="{{asset('images/shared/onlymemory.jpg')}}" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 22, 2017</small> -->
                        <h3><a href="#">The only memory that never fails is the cloud</a></h3>
                        <p>The human memory fails as we age. However, the cloud neither fails nor forgets. Write down your story when it’s fresh in your memory then store it in the cloud. Mycelebrationsbook.com will keep it safe forever.</p>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="{{asset('images/shared/cartoon.jpg')}}" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 18, 2017</small> -->
                        <h3><a href="blog-detail.html">Be in charge of your privacy.</a></h3>
                        <p>At my celebrationsbook.com, we keep secrets. Unlike the social media where everyone has access to your memories, my celebrations book allows you to invite only the people who care about you to contribute and celebrate with you. In addition, we give you the freedom to make your books public or private, and what you have made private will remain private.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="{{asset('images/shared/author.jpg')}}" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 14, 2017</small> -->
                        <h3><a href="blog-detail.html">Become the author of your own life story.</a></h3>
                        <p>With my celebrations book, you capture important moments and progressively build it over the years.
                            Imagine, for instance capturing your marriage life from wedding day and each consecutive anniversary!
                            The same applies to other yearly events such as birthdays, allowing you to keep the stories and images
                            of yourself and your loved ones, including the messages from others.</p>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="{{asset('images/shared/oneaccount.jpg')}}" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                        <h3><a href="blog-detail.html">One account; many books!</a></h3>
                        <p>How much can you hold in your mind, computer, phone, or photo album? At mycelebrationsbook.com
                            you can create as many books as possible, as often as you want. All you need to do is select an
                            appropriate subscription plan for your needs. Our pricing is affordable and so if you’re looking for near-
                            free cloud storage, you’re welcome to explore the available options.</p>
                    </div>
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
                    <h2>Latest Books</h2>
                    <span class="line-bar">...</span>
                </div>
            </div>

            @foreach($books as $book)
            <div class="col-md-3 col-sm-6">
                <!-- WORK THUMB -->
                <div class="work-thumb">
                    <a href="" class="image-popup">
                        <img src="{{$book->image}}" class="img-responsive" alt="Work">

                        <div class="work-info">
                            <h3>{{$book->title}}</h3>
                            <small>{{$book->user->name}}</small>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- WORK -->
<section id="work" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="section-title">
                    <h2>Ready to create your book?</h2>
                    <span class="line-bar">...</span>
                </div>
                <p class="mt-5">You can save your memories in 4 simple steps;</p>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="step">
                    <div class="step__title">STEP 1</div>
                    <div class="step__content">
                        <div class="step__description">
                            Create an account
                        </div>
                        <div class="step__icon">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="step">
                    <div class="step__title">STEP 2</div>
                    <div class="step__content">
                        <div class="step__description">
                            Select a subscription plan
                        </div>
                        <div class="step__icon">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="step">
                    <div class="step__title">STEP 3</div>
                    <div class="step__content">
                        <div class="step__description">
                            Start writing and uploading your photos
                        </div>
                        <div class="step__icon">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="step">
                    <div class="step__title">STEP 4</div>
                    <div class="step__content">
                        <div class="step__description">
                            Generate link to invite loved ones to send messages
                        </div>
                        <div class="step__icon">
                            <i class="fa fa-share" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="text-center" style="margin-top: 30px;">
                    <a href="{{ route('book-create') }}" class="btn btn-primary">Create your first book.</a>
                </div>
            </div>
        </div>


    </div>
</section>

@endsection