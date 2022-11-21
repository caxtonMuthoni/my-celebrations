<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="From special days such as weddings, birthdays, father's day, mother's day and baby showers, we help
you to create stories, upload photos and invite friends to send in comments and photos to help you
remember each event.">
    <meta name="keywords" content="Father's day ,Celebrations ,Holidays ,Weddings ,Memories ,Party ,December global holidays ,Christmas ,Diwali ,Merry Christmas ,Labor Day ,Christmas tree ,International women's day ,Bride ,Famous birthday ,4 th of July ,Wedding Cake ,Holiday today ,Wedding gown ,Good Friday ,Mothersday ,Tomorrow holiday ,Easter holidays ,Party central ,Memorial ,Briday makeup ,Just married ,Bachelorette party ,Free cloud storage ,Pre wedding ,Wedding bells ,Wedding shower ,Valentine's gifts for him">
    <meta name="author" content="Caxton Muthoni">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="main-app">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a href="/" class="celebration__navbar--logo heading heading--5 navbar-brand special__header">
                    <img class="celebration__navbar--logo--img" src="{{asset('images/branding/logo.jpeg')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('my-books')}}">{{ __('My Books') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('billing-plans')}}">{{ __('Billing') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('book-public-show')}}">{{ __('Public Books') }}</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="ms-2 btn btn__primary" href="{{ route('register') }}">{{ __('Create account') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item me-2">
                            <a class="ms-2 btn btn__primary" href="{{ route('book-create') }}">{{ __('Create new book') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center my-2">
                <div class="col-md-6">
                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                </div>
            </div>
        </div>

        <main class="py-2">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://mycondolencebook.com/public/website/js/turn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.0.279/build/pdf.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.7.570/build/pdf.min.js"></script> -->
    <script src="{{ asset('js/particlesjs/particles.min.js') }}" defer></script>
    <script src="{{ asset('js/particlesjs/app.js') }}" defer></script>


</body>

</html>