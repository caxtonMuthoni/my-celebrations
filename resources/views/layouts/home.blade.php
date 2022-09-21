<!DOCTYPE html>
<html lang="en">

<head>

    <title>Welcome to my celebration books</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="From special days such as weddings, birthdays, father's day, mother's day and baby showers, we help
you to create stories, upload photos and invite friends to send in comments and photos to help you
remember each event.">
    <meta name="keywords" content="Father's day ,Celebrations ,Holidays ,Weddings ,Memories ,Party ,December global holidays ,Christmas ,Diwali ,Merry Christmas ,Labor Day ,Christmas tree ,International women's day ,Bride ,Famous birthday ,4 th of July ,Wedding Cake ,Holiday today ,Wedding gown ,Good Friday ,Mothersday ,Tomorrow holiday ,Easter holidays ,Party central ,Memorial ,Briday makeup ,Just married ,Bachelorette party ,Free cloud storage ,Pre wedding ,Wedding bells ,Wedding shower ,Valentine's gifts for him">
    <meta name="author" content="Caxton Muthoni">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/step.css') }}">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<body>

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>


    <!-- MENU -->
    <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="/" class="navbar-brand-logo">
                    <img src="{{asset('images/branding/logo.jpeg')}}" alt="">
                </a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-nav-first">
                    <li><a href="/" class="smoothScroll">Home</a></li>
                    <li><a href="{{route('about-us')}}" class="smoothScroll">About</a></li>
                    <li><a href="{{route('book-public-show')}}" class="smoothScroll">Public books</a></li>
                    <li><a href="{{route('pricing')}}" class="smoothScroll">Plans</a></li>
                    <li><a href="{{route('categories')}}" class="smoothScroll">Categories</a></li>
                    <li><a href="{{route('faqs')}}" class="smoothScroll">FAQs</a></li>
                    <li><a href="#contact" class="smoothScroll">Contacts</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/home') }}">Dashboard</a>
                    </li>
                    @else
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                    @if (Route::has('register'))
                    <li class="section-btn"><a href="{{ route('register') }}">Join Us For Free!</a></li>
                    @endif
                    @endauth
                </ul>
            </div>

        </div>
    </section>
    @if(session('success') || session('error'))
    <section class="mt-5 w-100 container" style="margin-top: 40px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong> {{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong> {{session('error')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    @if ($errors->any())
    <section class="mt-5 w-100 container" style="margin-top: 40px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            </div>
        </div>
    </section>
    @endif

    @yield('content')

    <!-- CONTACT -->
    <section id="contact" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <h2>Contact us</h2>
                        <span class="line-bar">...</span>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8">

                    <!-- CONTACT FORM HERE -->
                    <form id="contact-form" role="form" action="{{route('contact-us-form')}}" method="post">
                        @csrf
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="Full Name" id="name" name="name" required>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input type="email" class="form-control" placeholder="Your Email" id="email" name="email" required>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input type="tel" class="form-control" placeholder="Your Phone" id="number" name="phone_number" required>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" id="cf-budgets" name="reason">
                                <option>Contact reason</option>
                                <option>Can't create a book</option>
                                <option>Can't upload book images</option>
                                <option>Pricing enquiries</option>
                                <option>Other reasons</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <textarea class="form-control" rows="6" placeholder="Your requirements" id="cf-message" name="message" required></textarea>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group mt-4 mb-4">
                                <div class="captcha" style="width:100%;">
                                    <span style="width:100%;">{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="Enter Captcha on the left" id="captcha" name="captcha" required>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <input type="submit" class="form-control" name="submit" value="Send Message">
                        </div>

                    </form>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="google-map">
                        <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.364608344307!2d36.80127391953077!3d-1.2681032326610508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f173c0a1f9de7%3A0xad2c84df1f7f2ec8!2sWestlands%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1656073547817!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="col-md-5 col-sm-12">
                    <div class="footer-thumb footer-info">
                        <h2>My Celebration Books</h2>
                        <p>
                            My celebrations book is a service from Broaden Reach Online Services (BROS),
                            an E-Commerce company committed to providing online solutions to every day needs.
                        </p>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Company</h2>
                        <ul class="footer-link">
                            <li><a href="/">Home</a></li>
                            <li><a href="{{route('about-us')}}">About Us</a></li>
                            <li><a href="{{route('book-public-show')}}">Public Books</a></li>
                            <li><a href="{{route('faqs')}}">Faqs</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Services</h2>
                        <ul class="footer-link">
                            <li><a href="{{route('pricing')}}">Plans</a></li>
                            <li><a href="#">contact us</a></li>
                            <li><a href="#">Terms and conditions</a></li>
                            <li><a href="#">Privacy policy</a></li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Find us</h2>
                        <p>Nairobi, <br> Nairobi Kenya</p>
                        <p>info@mycelebrationbooks.com</p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="footer-bottom">
                        <div class="col-md-6 col-sm-5">
                            <div class="copyright-text">
                                <p>Copyright &copy; {{date("Y")}} Mycelebrations.com</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <div class="phone-contact">
                                <p>Call us/ whatsapp <span>+254768069134/+254738121484</span></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="https://www.facebook.com/templatemo" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>


    <!-- MODAL -->
    <section class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-popup">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12 col-sm-12">
                                <div class="modal-title">
                                    <h2>My Celebration Books</h2>
                                </div>

                                <!-- NAV TABS -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#sign_up" aria-controls="sign_up" role="tab" data-toggle="tab">Create an account</a></li>
                                    <li><a href="#sign_in" aria-controls="sign_in" role="tab" data-toggle="tab">Sign In</a></li>
                                </ul>

                                <!-- TAB PANES -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="sign_up">
                                        <form action="#" method="post">
                                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                                            <input type="telephone" class="form-control" name="telephone" placeholder="Telephone" required>
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            <input type="submit" class="form-control" name="submit" value="Submit Button">
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade in" id="sign_in">
                                        <form action="#" method="post">
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            <input type="submit" class="form-control" name="submit" value="Submit Button">
                                            <a href="https://www.facebook.com/templatemo">Forgot your password?</a>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

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