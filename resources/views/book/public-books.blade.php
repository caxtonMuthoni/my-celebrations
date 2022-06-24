@extends('layouts.app')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="public-books">
    <div class="container row">
        @foreach ($books as $book)
        <div class="col-md-3">
            <div class="book-card shadow-sm">
                <div class="book-card__type">{{$book->category->name}}</div>
                <div class="book-card__image">
                    <img class="book-card__image--picture" src="{{$book->image}}" alt="book tittle">
                </div>
                <div class="book-card__content">
                    <div class="book-card__content--header text-secondary">{{ \Illuminate\Support\Str::limit($book->title, 24, '...') }}</div>
                    <div class="book-card__content--description">
                        {{ \Illuminate\Support\Str::limit($book->cover_message, 50, $end='...') }}
                    </div>
                </div>
                <div class="book-card__cta text-center p-2">
                    <a href="{{route('readBookPDf', $book->id)}}" class="btn btn-text text-uppercase text__primary">Read book</a>
                </div>
            </div>
        </div>
        @endforeach
        {{$books->links()}}
    </div>
</div>
@endsection