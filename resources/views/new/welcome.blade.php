@extends ('layouts.welcome')
@section ('content')
<header class="header">
    <div class="header__container">
        <div class="header__content">
            <h1 class="heading heading__1 header__title">My Celebrations Book, where memories never fail</h1>
            <p class="header__paragraph">
                We live our lives story by story through the memories we create.
                While it is important to preserve our most cherished memories,
                the human mind is limited. My celebrations book is now giving you an opportunity to capture,
                keep and share your happy moments in an online storage. From baby showers, to child naming ceremonies,
                rites of passage, birthdays, baptism, weddings, graduations, anniversaries,
                award ceremonies, trips, holidays and more, we shall help you keep your treasured memories safe.
            </p>
        </div>
        <div class="header__video-container">
            <video class="header__video" src="https://res.cloudinary.com/dqnvljory/video/upload/v1671645638/celebrationv2_mf4o9v.mp4" autoplay loop muted></video>
            <!-- <video class="header__video" src="/images/new/celebrationv2.mp4" autoplay loop muted></video> -->  
        </div>

        <div class="header__btns">
            <a href="{{ route('book-create') }}" class="btn btn__rounded header__btns--btn">Create new Book <i class="fa fa-plus"></i></a>
            <a href="#dos" class="btn btn__borderd  header__btns--btn header__btns--learn">Learn More <i class="fa fa-arrow-down"></i></a>
        </div>
    </div>
    <!-- <div class="particaljs particles-js" id="particles-js"></div> -->
</header>
<div class="particaljs particles-js-about" id="particles-js-about"></div>

<section id="dos" class="dos">
    <div class="dos__container">
        <h2 class="heading heading__2">What you can do</h2>
        <p class="heading__description">My celebrations book has created a platform for you to capture your special moments forever. This will help you to</p>
    </div>
    <div class="dos__content">
        <div class="dos__content--section dos__content--section--1">
            <ol class="dos__content--ul">
                <li class="dos__content--li">Record your memories of each event</li>
                <li class="dos__content--li">Upload the most important pictures</li>
                <li class="dos__content--li">Invite others contribute to your story by sending messages such as birthday wishes, congratulations for wedding, graduations etc. They can also share photos alongside the messages</li>
                <li class="dos__content--li">Download or print the book for a different form of storage or other uses.</li>
            </ol>

            <h4 class="heading heading__4">Why you need to write down your memories</h4>
            <ol class="dos__content--ul">
                <li class="dos__content--li">Establish a tradition of recording important events such as birthdays, wedding and anniversaries, graduation etc; all in one safe account!</li>
                <li class="dos__content--li">Re-live your good times and the messages from loved ones.</li>
                <li class="dos__content--li">Affordably keep your happy moments safe</li>
            </ol>
        </div>

        <div class="dos__content--section dos__content--section--2">
            <img src="{{asset('images/new/couple.png')}}" alt="" class="dos__contnent--img">
        </div>
    </div>
</section>

<section id="features" class="features">
    <div class="dos__container">
        <h2 class="heading heading__2">Our Features</h2>
        <p class="heading__description">A platform to capture your special moments forever.</p>
    </div>
    <div class="features__list">
        <div class="features__feature shadow_card">
            <div class="features__feature--img">
                <img class="features__feature--photo" src="{{asset('images/new/1.jpg')}}" alt="">
            </div>
            <div class="features__feature--content">
                <h4 class="heading heading__4 features__feature--title">The Only Memory That Never Fails Is The Cloud</h4>

                <p class="features__feature--text">
                    The human memory fails as we age. However, the cloud neither fails nor forgets.
                    Write down your story when it’s fresh in your memory then store it in the cloud.
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
                    At my celebrationsbook.com, we keep secrets. Unlike the social media where everyone has access
                    to your memories, my celebrations book allows you to invite only the people who care about you
                    to contribute and celebrate with you. In addition, we give you the freedom to make your books
                    public or private, and what you have made private will remain private.
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
                    With my celebrations book, you capture important moments and progressively build it over
                    the years. Imagine, for instance capturing your marriage life from wedding day and each
                    consecutive anniversary! The same applies to other yearly events such as birthdays,
                    allowing you to keep the stories and images of yourself and your loved ones, including the
                    messages from others.
                </p>
            </div>
        </div>

        <div class="features__feature shadow_card">
            <div class="features__feature--img">
                <img class="features__feature--photo" src="{{asset('images/new/4.jpg')}}" alt="">
            </div>
            <div class="features__feature--content">
                <h4 class="heading heading__4 features__feature--title">One Account; Many Books!</h4>

                <p class="features__feature--text">
                    How much can you hold in your mind, computer, phone, or photo album?
                    At mycelebrationsbook.com you can create as many books as possible, as often as you want.
                    All you need to do is select an appropriate subscription plan for your needs. Our pricing
                    is affordable and so if you’re looking for near- free cloud storage, you’re welcome to
                    explore the available options.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="latest">
    <div class="dos__container">
        <h2 class="heading heading__2">Latest Books</h2>
        <p class="heading__description">My celebrations book has created a platform for you to capture your special moments forever. This will help you to</p>
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