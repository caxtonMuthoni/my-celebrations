@extends('layouts.app')

@section('content')
<div class="container">
    <div class="stats-cards">
        <div class="stats-card shadow-sm">
            <i class="fa fa-book stats-card__icon" aria-hidden="true"></i>
            <div class="stats-card__value">20</div>
            <div class="stats-card__description">Total Books</div>
        </div>

        <div class="stats-card shadow-sm">
            <i class="fa fa-check stats-card__icon" aria-hidden="true"></i>
            <div class="stats-card__value">10</div>
            <div class="stats-card__description">Published Books</div>
        </div>

        <div class="stats-card shadow-sm">
            <i class="fa fa-copy stats-card__icon" aria-hidden="true"></i>
            <div class="stats-card__value">2</div>
            <div class="stats-card__description">Draft Books</div>
        </div>

        <div class="stats-card shadow-sm">
            <i class="fa fa-envelope stats-card__icon" aria-hidden="true"></i>
            <div class="stats-card__value">150</div>
            <div class="stats-card__description">Total Messages</div>
        </div>

    </div>
    <h3 class="heading heading--5 text__dark">
        Latest Books
    </h3>
    <div class="book-cards">
        @for($i= 0; $i < 4; $i++)
         <div class="book-card shadow-sm">
            <div class="book-card__type">Birthday</div>
            <div class="book-card__image">
                <img class="book-card__image--picture" src="{{asset('/images/book.svg')}}" alt="book tittle">
            </div>
            <div class="book-card__content">
                <div class="book-card__content--header text-secondary">Happy Birthday Caxton Muthoni</div>
                <div class="book-card__content--description">Dear Caxton Muthoni, I am writting this to wish you a Happy Birthday</div>
            </div>
        </div>
    @endfor
</div>

</div>
@endsection