@extends('layouts.app')

@section('content')
<div class="container">
    <div class="stats-cards row">
        <div class="col-md-3">
            <div class="stats-card shadow-sm">
                <i class="fa fa-book stats-card__icon" aria-hidden="true"></i>
                <div class="stats-card__value">{{$data['books']}}</div>
                <div class="stats-card__description">Total Books</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card shadow-sm">
                <i class="fa fa-check stats-card__icon" aria-hidden="true"></i>
                <div class="stats-card__value">{{ $data['published'] }}</div>
                <div class="stats-card__description">Published Books</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card shadow-sm">
                <i class="fa fa-copy stats-card__icon" aria-hidden="true"></i>
                <div class="stats-card__value">{{ $data['draft'] }}</div>
                <div class="stats-card__description">Draft Books</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card shadow-sm">
                <i class="fa fa-envelope stats-card__icon" aria-hidden="true"></i>
                <div class="stats-card__value">{{ $data['messages'] }}</div>
                <div class="stats-card__description">Total Messages</div>
            </div>
        </div>
    </div>
    <h3 class="heading heading--5 text__dark">
        Latest Books
    </h3>
    <div class="book-cards row">
        @foreach($data['latest_books'] as $book)
        <div class="col-md-3">
            <div class="book-card shadow-sm">
                <div class="book-card__type">{{$book->category->name}}</div>
                <div class="book-card__image">
                    <img class="book-card__image--picture" src="{{$book->image}}" alt="book tittle">
                </div>
                <div class="book-card__content">
                    <div class="book-card__content--header text-secondary">{{ $book->title }}</div>
                    <div class="book-card__content--description">
                        {{ $book->cover_message }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection