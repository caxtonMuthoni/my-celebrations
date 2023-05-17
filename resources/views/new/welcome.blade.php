@extends ('layouts.welcome')
@section ('content')
<header class="header">
    <div class="header__container">
        <div class="header__content">
            <h1 class="heading heading__1 header__title">&nbsp;</h1>
            <p class="header__paragraph">
            </p>
        </div>
        <div class="header__video-container">
            <video id="doc-player" class="header__video cld-video-player cld-fluid" autoplay loop muted></video>
            <!-- <video class="header__video" src="/images/new/celebrationv2.mp4" autoplay loop muted></video> -->
        </div>

        <div class="header__btns">
            <a href="{{ route('book-create') }}" class="btn btn__rounded header__btns--btn">Create new Book <i class="fa fa-plus"></i></a>
            <a href="#dos" class="btn btn-primary  header__btns--bt header__btns--lear">Learn More <i class="fa fa-arrow-down"></i></a>
        </div>
    </div>
    <!-- <div class="particaljs particles-js" id="particles-js"></div> -->
</header>
<section id="introduction" class="introduction">
    <div class="dos__container">
        <h2 class="heading heading__2">My Celebrations Book, where memories never fail</h2>
        <p class="heading__description"> We live our lives story by story, event by event, occasion by occasion.
            These are captured in many ways: in photos, videos, and journals among others.
            At the very best, these happy moments will likely be disjointed and possibly lost over time, unless we find a way of keeping them together.
        </p>
        <h3>That is why my celebration books portal exists.</h3>
        <p class="heading__description">
            This amazing innovation gives you an opportunity to capture, keep, and share your happy moments in an online storage.
            From baby showers, to child naming ceremonies, rites of passage, birthdays, baptism, weddings, graduations, anniversaries, award ceremonies, trips, holidays and more, we shall help you keep your treasured memories safe.
            Better still, open the book to friends and family to send messages and pictures!
        </p>
    </div>
</section>
<!-- <div class="particaljs particles-js-about" id="particles-js-about"></div> -->

<section id="dos" class="dos">
    <div class="dos__container">
        <h2 class="heading heading__2">What you can do</h2>
        <p class="heading__description">My celebration books has created a platform for you to capture your special moments forever. You will be able to:</p>
    </div>
    <div class="dos__content">
        <div class="dos__content--section dos__content--section--1">
            <ol class="dos__content--ul">
                <li class="dos__content--li">Create a narrative for each event, those things that really stood out for you; the things you will always want to remember.</li>
                <li class="dos__content--li">Select and upload the most important pictures. You will of course have tomes of pictures but only a few are necessary to capture the moments. Add captions for future reference </li>
                <li class="dos__content--li">Invite others to be part of the story sending messages such as birthday wishes, congratulations for wedding, graduations etc. They too can send you photos or images from which you can select some to include in the book</li>
                <li class="dos__content--li">Retain the book as an online version, download, and/or print. </li>
                <li class="dos__content--li">Re-live those beautiful times in the comfort of your private space! </li>
            </ol>

            <i class="heading heading__4">Picture that beautiful wedding, birthday, or graduation book as part of your library; complete with your own narrative and pictures, as well as messages and pictures from loved ones!
            </i>


            <!-- <ol class="dos__content--ul">
                <li class="dos__content--li">Establish a tradition of recording important events such as birthdays, wedding and anniversaries, graduation etc; all in one safe account!</li>
                <li class="dos__content--li">Re-live your good times and the messages from loved ones.</li>
                <li class="dos__content--li">Affordably keep your happy moments safe</li>
            </ol> -->
        </div>

        <div class="dos__content--section dos__content--section--2">
            <div class="">
                <swiper-container class="swipper" pagination autoplay slides-per-view="1" css-mode="true" speed="500" loop="true" class="bg-success">
                    <swiper-slide class="swiper-img"><img src="{{asset('images/new/couple.png')}}" alt="" class="dos__content--img"></swiper-slide>
                    <swiper-slide class="swiper-img"><img src="{{asset('images/new/about.png')}}" alt="" class="dos__content--img"></swiper-slide>
                    <swiper-slide class="swiper-img"><img src="{{asset('images/new/header-bg.jpg')}}" alt="" class="dos__content--img"></swiper-slide>
                    <swiper-slide class="swiper-img"><img src="{{asset('images/new/2.jpg')}}" alt="" class="dos__content--img"></swiper-slide>
                    <swiper-slide class="swiper-img"><img src="{{asset('images/new/1.jpg')}}" alt="" class="dos__content--img"></swiper-slide>
                </swiper-container>
            </div>
        </div>
    </div>
</section>

<section id="features" class="features">
    <div class="dos__container">
        <h2 class="heading heading__2">Our Features</h2>
        <p class="heading__description">All these in a private, invite only book, safely kept for you at a most affordable cost.</p>
    </div>
    <div class="features__list">
        <div class="features__feature shadow_card">
            <div class="features__feature--img">
                <img class="features__feature--photo" src="{{asset('images/new/1.jpg')}}" alt="">
            </div>
            <div class="features__feature--content">
                <h4 class="heading heading__4 features__feature--title">The Only Memory That Never Fails Is The Cloud</h4>

                <p class="features__feature--text">
                    The human memory fails as we age and records get lost or misplaced. However, the cloud never forgets.
                    Write down your story when it’s fresh, then store it in the cloud.
                    Mycelebrationsbook.com will keep it safe forever.
                </p>
            </div>
        </div>

        <div class="features__feature shadow_card">
            <div class="features__feature--img">
                <img class="features__feature--photo" src="{{asset('images/new/2.jpg')}}" alt="">
            </div>
            <div class="features__feature--content">
                <h4 class="heading heading__4 features__feature--title">Be In Charge Of Your Privacy.</h4>

                <p class="features__feature--text">
                    At my celebrationsbook.com, we keep secrets. Unlike the social media where everyone has access to your records,
                    my celebrations book allows you to invite only the people who care about you to celebrate with you.
                    In addition, we give you the freedom to make your books public or private, and what you have made private will remain private.
                </p>
            </div>
        </div>

        <div class="features__feature shadow_card">
            <div class="features__feature--img">
                <img class="features__feature--photo" src="{{asset('images/new/3.jpg')}}" alt="">
            </div>
            <div class="features__feature--content">
                <h4 class="heading heading__4 features__feature--title">Become The Author Of Your Own Life Story.</h4>

                <p class="features__feature--text">
                    With my celebrations book, you capture important moments and progressively build it over the years.
                    Imagine, for instance, capturing your marriage life from wedding day and each consecutive anniversary.
                    It’s a wonderful gift to yourself. <br>

                    Other yearly events such as birthdays, are great candidates for a celebration book, capturing life through the ages. Get rolling, now.


                </p>
            </div>
        </div>

        <div class="features__feature shadow_card">
            <div class="features__feature--img">
                <img class="features__feature--photo" src="{{asset('images/new/books.jpg')}}" alt="">
            </div>
            <div class="features__feature--content">
                <h4 class="heading heading__4 features__feature--title">One Account; Many Books!</h4>

                <p class="features__feature--text">
                    How much can you hold in your mind, computer, phone, or photo album?
                    At mycelebrationsbook.com you can create as many books as possible, as often as you want.
                    All you need to do is select an appropriate subscription plan for your needs.
                    Our pricing is affordable and so if you’re looking for near- free cloud storage, you’re welcome to explore the available options.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="latest">
    <div class="dos__container">
        <h2 class="heading heading__2">Latest Books</h2>
        <p class="heading__description">Here are some of the latest books created by our happy customers.</p>
    </div>
    <div class="latest__books">
        @foreach($books as $book)
        <a href="{{route('readBookPDf', $book->id)}}" class="latest__books--book shadow_card">
            <div class="latest__books--book--img">
                <img src="{{$book->image}}" alt="" class="latest__books--book--photo">
            </div>
            <div class="latest__books--book--content">
                <h4 class="heading heading__4 latest__books--book--heading">{{$book->title}}</h4>
                <p class="latest__books--book--cover-message">
                    {{$book->cover_message}}
                </p>
            </div>
        </a>
        @endforeach

    </div>
</section>
<section class="steps">
    <div class="dos__container">
        <h2 class="heading heading__2">Ready to create your book?</h2>
        <p class="heading__description">You can save your memories in 4 simple steps;</p>
    </div>
    <div class="steps__list">
        <div class="steps__step">
            <i class="steps__step--icon fa fa-edit"></i>
            <h4 class="heading heading__4">Step 1</h4>
            <p class="steps__step--description">
                Create an account
            </p>
        </div>

        <div class="steps__step">
            <i class="steps__step--icon fa fa-money-bill"></i>
            <h4 class="heading heading__4">Step 2</h4>
            <p class="steps__step--description">
                Select a subscription plan
            </p>
        </div>

        <div class="steps__step">
            <i class="steps__step--icon fa fa-book"></i>
            <h4 class="heading heading__4">Step 3</h4>
            <p class="steps__step--description">
                Start writing and uploading your photos
            </p>
        </div>

        <div class="steps__step">
            <i class="steps__step--icon fa fa-share"></i>
            <h4 class="heading heading__4">Step 4</h4>
            <p class="steps__step--description">
                Generate link to invite loved ones to send messages
            </p>
        </div>
    </div>
    <div class="steps__cta">
        <a href="{{ route('book-create') }}" class="btn btn__borderd">Create your first book</a>
    </div>
</section>

@include('includes.contact')

@endsection