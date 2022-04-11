@extends('layouts.app')
@section('content')
<div class="book-read container">
    <div class="text-right book-read__cta my-2">
        <a href="{{route('book-message', $book->id)}}" class="btn btn-info me-4">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            Add message</a>

        <a href="{{route('book-images', $book->id)}}" class="btn btn-primary">
            <i class="fa fa-image" aria-hidden="true"></i>
            Add images</a>
    </div>
    <div class="bg-white p-5">
        <h2>{{$book->title}}</h2>
        <h4> {{$book->cover_message}}</h4>
    </div>
    <div class="bg-white p-5">
        {!! $book->content->content !!}
    </div>
</div>
@endsection