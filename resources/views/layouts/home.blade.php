<!DOCTYPE html>
<html lang="en">

<head>

    <title>Welcome to my celebration books</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
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
                    <li><a href="{{route('pricing')}}" class="smoothScroll">Pricing</a></li>
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
                    <form id="contact-form" role="form" action="#" method="post">
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="Full Name" id="cf-name" name="cf-name" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input type="email" class="form-control" placeholder="Your Email" id="cf-email" name="cf-email" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input type="tel" class="form-control" placeholder="Your Phone" id="cf-number" name="cf-number" required="">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" id="cf-budgets" name="cf-budgets">
                                <option>Contact reason</option>
                                <option>Can't create a book</option>
                                <option>Can't upload book images</option>
                                <option>Pricing enquiries</option>
                                <option>Other reasons</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <textarea class="form-control" rows="6" placeholder="Your requirements" id="cf-message" name="cf-message" required=""></textarea>
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.3030413476204!2d100.5641230193719!3d13.757206847615207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf51ce6427b7918fc!2sG+Tower!5e0!3m2!1sen!2sth!4v1510722015945" allowfullscreen></iframe>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Company</h2>
                        <ul class="footer-link">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Join our team</a></li>
                            <li><a href="#">Read Blog</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Services</h2>
                        <ul class="footer-link">
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4">
                    <div class="footer-thumb">
                        <h2>Find us</h2>
                        <p>123 Grand Rama IX, <br> Krung Thep Maha Nakhon 10400</p>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="footer-bottom">
                        <div class="col-md-6 col-sm-5">
                            <div class="copyright-text">
                                <p>Copyright &copy; 2017 Your Company</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <div class="phone-contact">
                                <p>Call us <span>+254743751575</span></p>
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

</body>

</html>