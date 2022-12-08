<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/home/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>My Celebration books</title>

</head>

<body>
    <nav class="nav">
        <a href="/new/design" class="nav__brand">
            <img src="{{asset('images/branding/logo.jpeg')}}" alt="" class="nav__brand--logo">
        </a>
        <div class="nav__container">
            <ul class="nav__ul">
                <li class="nav__li"><a href="/new/design" class="nav__link js_home">Home</a></li>
                <li class="nav__li"><a href="{{route('new-about')}}" class="nav__link js_about">About</a></li>
                <li class="nav__li"><a href="{{route('book-public-show')}}" class="nav__link">Public Books</a></li>
                <li class="nav__li"><a href="{{route('new-plans')}}" class="nav__link js_plans">Plans</a></li>
                <li class="nav__li"><a href="{{route('new-categories')}}" class="nav__link js_categories">Categories</a></li>
                <li class="nav__li"><a href="{{route('new-faqs')}}" class="nav__link js_faqs">FAQs</a></li>
                <li class="nav__li"><a href="#contact" class="nav__link js_contact">Contact</a></li>
                @auth
                <li class="nav__li"><a href="{{ url('/home') }}" class="nav__link">Dashboard</a></li>
                @else
                <li class="nav__li"><a href="{{ route('login') }}" class="nav__link">Sign In</a></li>
                @if (Route::has('register'))
                <li class="nav__li"><a href="{{ route('register') }}" class="btn btn__rounded">Join us for free!</a></li>
                @endif
                @endauth
            </ul>
            <span class="fa fa-bars nav__icon"></span>
        </div>
    </nav>

    @yield('content')

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
                        <a href="/new/design" class="footer__link">Home</a>
                    </li>
                    <li class="footer__li">
                        <a href="{{route('new-about')}}" class="footer__link">About Us</a>
                    </li>
                    <li class="footer__li">
                        <a href="{{route('book-public-show')}}" class="footer__link">Public books</a>
                    </li>
                    <li class="footer__li">
                        <a href="{{route('new-faqs')}}" class="footer__link">FAQs</a>
                    </li>
                </ul>
            </div>

            <div class="footer__menu">
                <h3 class="heading heading__3 footer__heading footer__heading">Services</h3>
                <ul class="footer__ul">
                    <li class="footer__li">
                        <a href="{{route('new-plans')}}" class="footer__link">Plans</a>
                    </li>
                    <li class="footer__li">
                        <a href="#contact" class="footer__link">Contact Us</a>
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

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/new/app.js')}}"></script>
    <script src="{{ asset('js/particlesjs/particles.min.js') }}" defer></script>
    <script src="{{ asset('js/particlesjs/app.js') }}" defer></script>

    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</body>

</html>