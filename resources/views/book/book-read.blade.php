@extends('layouts.app')
@section('content')
<div class="book-read">
    <div class="container">
        <div class="text-right book-read__cta my-2">
            <!-- <button onclick="expandScreen()" id="expandButton" class="btn btn-secondary me-2"> <i class="fa fa-expand me-2" aria-hidden="true"></i> Full screen</button> -->
            <!-- <a href="{{route('readBookPDf', $id)}}" class="btn btn-info me-2"><i class="fa fa-book me-2" aria-hidden="true"></i> Read</a> -->
            @if($book->user_id != Auth::id())
            <a href="{{route('book-message', $id)}}" class="btn btn-sm btn-sm btn-info me-4">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                Add message</a>

            <a href="{{route('book-images', $id)}}" class="btn btn-sm btn-primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Add images</a>

            @else
            <a href="{{route('book-transfer', $id)}}" class="btn btn-sm btn-info me-2">
                <i class="fa fa-cut me2" aria-hidden="true"></i>
                Book Transfer</a>

            <a href="{{route('book-show', $id)}}" class="btn btn-sm btn-primary me-2">
                <i class="fa fa-edit me-2" aria-hidden="true"></i>
                Edit</a>
            @if(!$book->published)
            <a href="{{route('publish-book', $id)}}" class="btn btn-sm btn__primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Publish</a>
            @else
            <a href="{{route('publish-book', $id)}}" class="btn btn-sm btn-warning">
                <i class="fa fa-image" aria-hidden="true"></i>
                Switch to Draft</a>
            @endif
            @endif
        </div>
    </div>
    <!-- <div class="book container px-5">
        <div class="book__cover-page">
            <div class="book__image">
                <img src="{{$book->image}}" style="max-width: 200px;" alt="" class="book__image--photo">
            </div>
            <h1 class="book__title">{{$book->title}}</h1>
            <h4 class="book__cover-message">
                {{$book->cover_message}}
            </h4>
        </div>
        <div class="book__content">
            {!! $book->content->content !!}
        </div>
        <div class="book__images mt-5">
            <h4 class="book__images--title">Book Gallery</h4>
            @foreach($book->bookImages as $image)
            <div class="book__images--image" style="margin-bottom: 30px;">
                <img src="{{$image->image}}" style="max-width: 400px;" alt="" class="book__images--photo">
                <caption>{{$image->caption}}</caption>
            </div>
            @endforeach
        </div>
        <div class="book__messages">
            <h4 class="book__messages--title">Book messages</h4>
            @foreach($book->bookMessages as $message)
            <div class="book__messages--container">
                <p class="book__messages--message">
                    {{$message->message}}
                <div class="book__messages--cta">
                    <span>{{$message->relationship}}</span>
                    <span>{{$message->user->name}}</span>
                </div>
                </p>
            </div>
            @endforeach
        </div>
    </div> -->

    <div class="mt-0 pt-0">
        <book-reader pdfurl="{{$pdfurl}}" :book="{{$book}}" shorturl="{{$shorturl}}"></book-reader>
    </div>
</div>

@endsection