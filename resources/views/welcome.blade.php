<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Celebrations</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="antialiased">
    <div class="celebration">
        @if (Route::has('login'))

        <nav class="celebration__navbar navbar navbar-expand-lg navbar-light bg-light">
            <a href="/" class="celebration__navbar--logo heading heading--5 navbar-brand special__header">
                <i class="fa fa-book me-1" aria-hidden="true"></i>
                My<span class="celebration__navbar--logo-color">Celebration</span>Books
            </a>
            <div class="d-flex">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link">Dashboard</a>
                        </li>
                        @else

                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Sign In</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn__primary">Create Account</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <div class="celebration__header">

            <div class="celebration__header--content">
                <div class="heading heading--1"><span class="text__dark">Celebration</span> <span class="text__primary">Books Generator</span></div>
                <p class="paragraph paragraph__1 mt-1">
                    Make a professional celebration books with a smart tool in just a few clicks!
                    Help your customers identify you and the services you provide and increase your credibility.
                </p>
                <a href="{{route('book-create')}}" class="btn btn-lg btn__primary mt-3">Create new celebration book</a>
            </div>

            <div class="celebration__header--image">
                <img class="celebration__header--picture" src="{{asset('/images/book.svg')}}" alt="book image">
            </div>

        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>