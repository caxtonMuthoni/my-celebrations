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
    @if(count($data['latest_books']) > 0)
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

                <div class="book-card__cta p-2">
                    <a href="{{route('book-show', $book->id)}}" title="Edit book content" class="book-card__cta-btn btn btn-sm btn-info">
                        <i class="fa fa-edit"></i> Content
                    </a>

                    <a href="{{route('edit-book-details', $book->id)}}" title="Edit cover content" class="book-card__cta-btn btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i> Cover
                    </a>

                    <span class="">
                        @if($book->public)
                        <span class="btn btn-sm btn-warning">public</span>
                        @else
                        <span class="btn btn-sm btn-primary">private</span>
                        @endif
                    </span>

                    <span class="">
                        @if($book->published)
                        <span class="btn btn-sm btn-success">published</span>
                        @else
                        <span class="btn btn-sm btn-info">draft</span>
                        @endif
                    </span>
                </div>
                <div class="book-card__cta p-2">
                    <span>
                        @if($book->accepting_message)
                        <a href="{{ route('book-view-messages-pictures', $book->id) }}" title="view book messages" class="book-card__cta-btn btn btn-sm btn-primary">
                            <i class="fa fa-envelope"></i> Messages
                        </a>
                        @else
                        <span class="btn btn-sm btn-primary">No message</span>
                        @endif
                    </span>

                    <span>
                        @if($book->accepting_message)
                        <a href="{{ route('book-view-messages-pictures', $book->id) }}" title="view book pictures" class="book-card__cta-btn btn btn-sm btn-info">
                            <i class="fa fa-image"></i> Pictures
                        </a>
                        @else
                        <span class="btn btn-sm btn-primary">No pictures</span>
                        @endif
                    </span>

                    <a href="{{route('readBookPDf', $book->id)}}" title="Read book" class="book-card__cta-btn btn btn-sm btn-success">
                        <i class="fa fa-book"></i> Read
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="row justify-content-center mt-3">
        <div class="col-md-6 text-center">
            <div class="alert alert-warning">You have not created any book.</div>
            <a href="{{route('book-create')}}" class="btn btn-lg btn__primary mt-3">Create new celebration book</a>
        </div>
    </div>
    @endif

</div>
@endsection