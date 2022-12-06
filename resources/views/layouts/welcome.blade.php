<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Celebration books</title>
    <link rel="stylesheet" href="{{asset('css/home/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <nav class="nav">
        <a href="/" class="nav__brand">
            <img src="{{asset('images/branding/logo.jpeg')}}" alt="" class="nav__brand--logo">
        </a>
        <div class="nav__container">
            <ul class="nav__ul">
                <li class="nav__li"><a href="" class="nav__link nav__link--active">Home</a></li>
                <li class="nav__li"><a href="" class="nav__link">About</a></li>
                <li class="nav__li"><a href="" class="nav__link">Public Books</a></li>
                <li class="nav__li"><a href="" class="nav__link">Plans</a></li>
                <li class="nav__li"><a href="" class="nav__link">Categories</a></li>
                <li class="nav__li"><a href="" class="nav__link">FAQs</a></li>
                <li class="nav__li"><a href="#contact" class="nav__link">Contact</a></li>
                @auth
                <li class="nav__li"><a href="" class="nav__link">Dashboard</a></li>
                @else
                <li class="nav__li"><a href="" class="nav__link">Sign In</a></li>
                @if (Route::has('register'))
                <li class="nav__li"><a href="" class="btn btn__rounded">Join us for free!</a></li>
                @endif
                @endauth
            </ul>
            <span class="fa fa-bars nav__icon"></span>
        </div>
    </nav>
    <header class="header">
        <div class="header__container">
            <h1 class="heading heading__1 header__title">My Celebrations Book, where memories never fail</h1>
            <p class="header__paragraph">
                We live our lives story by story through the memories we create.
                While it is important to preserve our most cherished memories,
                the human mind is limited. My celebrations book is now giving you an opportunity to capture,
                keep and share your happy moments in an online storage. From baby showers, to child naming ceremonies,
                rites of passage, birthdays, baptism, weddings, graduations, anniversaries,
                award ceremonies, trips, holidays and more, we shall help you keep your treasured memories safe.
            </p>

            <div class="header__btns">
                <a href="" class="btn btn__borderd header__btns--btn">Create new Book <i class="fa fa-plus"></i></a>
                <a href="#dos" class="btn btn__rounded header__btns--btn header__btns--learn">Learn More <i class="fa fa-arrow-down"></i></a>
            </div>
        </div>
    </header>

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
            <div class="features__feature">
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

            <div class="features__feature">
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

            <div class="features__feature">
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

            <div class="features__feature">
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
            <a href="#" class="latest__books--book">
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
            <a href="" class="btn btn__borderd">Create your first book</a>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="dos__container">
            <h2 class="heading heading__2">Contact us</h2>
            <p class="heading__description">Need help ? Get in touch with us.</p>
        </div>
        <div class="contact__details">
            <div class="contact__form">
                <form id="contact-form" role="form" action="{{route('contact-us-form')}}" method="post">
                    @csrf

                    <input type="text" class="form-control" placeholder="Full Name" id="name" name="name" required>

                    <input type="email" class="form-control" placeholder="Your Email" id="email" name="email" required>

                    <input type="tel" class="form-control" placeholder="Your Phone" id="number" name="phone_number" required>

                    <select class="form-control" id="cf-budgets" name="reason">
                        <option>Contact reason</option>
                        <option>Can't create a book</option>
                        <option>Can't upload book images</option>
                        <option>Pricing enquiries</option>
                        <option>Other reasons</option>
                    </select>

                    <textarea class="form-control" rows="6" placeholder="Your requirements" id="cf-message" name="message" required></textarea>
                    <div class="contact__captcha">
                        <span style="width:100%;">{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn__rounded" class="reload" id="reload">
                            &#x21bb;
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter Captcha on the left" id="captcha" name="captcha" required>

                    <div class="col-md-4 col-sm-12">
                        <input type="submit" class="btn btn__rounded" name="submit" value="Send Message">
                    </div>

                </form>
            </div>
            <div class="contact__map">
                <iframe class="contact__map--map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.364608344307!2d36.80127391953077!3d-1.2681032326610508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f173c0a1f9de7%3A0xad2c84df1f7f2ec8!2sWestlands%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1656073547817!5m2!1sen!2ske" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer__content">
            <div class="footer__title">
                <h3 class="heading heading__3 footer__heading">My Celebration Books</h3>
                <p class="footer__paragraph">My celebrations book is a service from Broaden Reach Online Services (BROS), an E-Commerce company committed to providing online solutions to every day needs.</p>
            </div>
            <div class="footer__menu">
                <h3 class="heading heading__3 footer__heading">Company</h3>
                <ul class="footer__ul">
                    <li class="footer__li">
                        <a href="" class="footer__link">Home</a>
                    </li>
                    <li class="footer__li">
                        <a href="" class="footer__link">About Us</a>
                    </li>
                    <li class="footer__li">
                        <a href="" class="footer__link">Public books</a>
                    </li>
                    <li class="footer__li">
                        <a href="" class="footer__link">FAQs</a>
                    </li>
                </ul>
            </div>

            <div class="footer__menu">
                <h3 class="heading heading__3 footer__heading footer__heading">Services</h3>
                <ul class="footer__ul">
                    <li class="footer__li">
                        <a href="" class="footer__link">Plans</a>
                    </li>
                    <li class="footer__li">
                        <a href="" class="footer__link">Contact Us</a>
                    </li>
                    <li class="footer__li">
                        <a href="" class="footer__link">Terms and conditions</a>
                    </li>
                    <li class="footer__li">
                        <a href="" class="footer__link">Privacy policy</a>
                    </li>
                </ul>
            </div>

            <div class="footer__menu">
                <h3 class="heading heading__3 footer__heading">Find us</h3>
                <ul class="footer__ul">
                    <li class="footer__li">
                        Nairobi,
                    </li>
                    <li class="footer__li">
                        Nairobi Kenya
                    </li>
                    <li class="footer__li">

                        info@mycelebrationbooks.com
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__legal">
            <div class="">
                <div class="copyright-text">
                    <p>Copyright &copy; {{date("Y")}} Mycelebrations.com</p>
                </div>
            </div>
            <div class="footer__cta">
                <div class="phone-contact">
                    <p>Call us/ whatsapp <span>+254768069134/+254738121484</span></p>
                </div>
                <!-- <ul class="social-icon">
                    <li><a href="https://www.facebook.com/templatemo" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul> -->
            </div>
        </div>
    </footer>

    <script src="{{asset('js/new/app.js')}}"></script>
</body>

</html>