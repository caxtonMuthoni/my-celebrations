@extends('layouts.home')
@section('content')
<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="home-info">
                    <h1>My Celebrations Book, where memories never fail</h1>
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

            <div class="col-md-6 col-sm-12">
                <div class="home-video">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src="https://www.youtube.com/embed/jdjYt7DFsZg" frameborder="0" allowfullscreen></iframe>
                    </div>
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
                    <img src="images/about-image.jpg" class="img-responsive" alt="">
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
                        <a href="blog-detail.html"><img src="images/blog-image1.jpg" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 22, 2017</small> -->
                        <h3><a href="#">The only memory that never fails.</a></h3>
                        <p>The human memory fails as we age. However, the cloud neither fails nor forgets.
                            Write down your story when it’s
                            fresh in your memory then store it in the cloud. Mycelebrationsbook.com will keep it safe forever.</p>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="images/blog-image2.jpg" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 18, 2017</small> -->
                        <h3><a href="blog-detail.html">Be in charge of your privacy.</a></h3>
                        <p>At my celebrationsbook.com, we keep secrets. Unlike the social media where everyone has access to your memories, my celebrations book allows you to invite only the people who care about you to contribute and celebrate with you.
                            In addition, we give you the freedom to make your books public or private, and what you have made private will remain private forever.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="images/blog-image3.jpg" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 14, 2017</small> -->
                        <h3><a href="blog-detail.html">Become an author within a short period of time.</a></h3>
                        <p>People take years to publish their first book. Others must take a course, go through an editor and the bureaucratic publishing process. With my celebrations book, you are your own boss. All you need is an internet-enabled gadget and friends. Give your book a title then invite others to fill it with content free of charge.
                            Your friends and family will help co-create your book as fast as within a day!</p>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BLOG THUMB -->
                <div class="media blog-thumb">
                    <div class="media-object media-left">
                        <a href="blog-detail.html"><img src="images/blog-image4.jpg" class="img-responsive" alt=""></a>
                    </div>
                    <div class="media-body blog-info">
                        <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                        <h3><a href="blog-detail.html">The storage space is unlimited!</a></h3>
                        <p>How much can you hold in your mind, computer, phone, or photo album? Well, the space at mycelebrationsbook.com is unlimited. You can create as many books as possible, as often as you want.
                            All you need to do is select an appropriate subscription plan for your needs.
                            Our pricing is affordable and so if you’re looking for near-free cloud storage, you’re welcome to explore the available options.</p>
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

@endsection