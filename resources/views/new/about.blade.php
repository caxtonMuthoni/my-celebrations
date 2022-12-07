@extends ('layouts.welcome')
@section ('content')
<header class="about__header">
    <h2 class="heading heading__3">About Us</h2>
    <p class="about__header--paragraph">
        My celebrations book is a service from Broaden Reach Online Services (BROS), an E-Commerce company
        committed to providing online solutions to every day needs. Our vision to be a globally recognized
        brand in digital document creation services. We stand for honesty, timeliness, efficiency, customer
        focus and integrity in our services to you, our customer. Welcome onboard, enjoy the ride.
    </p>
</header>

<section class="about__content">
    <div class="dos__container">
        <h2 class="heading heading__2">Memories</h2>
        <p class="heading__description">We live our lives story by story through the memories we create.</p>
    </div>
    <div class="about__content--sections">
        <div class="about__content--section about__content--section--1">
            <p class="about__header--paragraph">
                While it is important to preserve
                our most cherished memories, the human mind cannot remember forever. My celebrations book is now
                giving you an opportunity to capture, keep and share your happy moments in an online storage.
            </p>

            <p class="about__header--paragraph">
                From baby showers, to child naming ceremonies, rites of passage, birthdays, baptism, weddings,
                graduations, anniversaries, award ceremonies, trips, holidays and more, we shall help you keep your
                treasured memories safe.
            </p>
        </div>
        <div class="about__content--section about__content--section--2">
            <img src="{{asset('images/new/happy.png')}}" alt="" class="about__content--img">
        </div>
    </div>
</section>
@include('includes.contact')

@endsection