@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-3 mt-0 pt-0">
        <div class="col-md-6">
            @if($book->user_id != Auth::id())
            <a href="{{route('book-message', $book->id)}}" class="btn btn-info me-4">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                Add message</a>

            <a href="{{route('book-images', $book->id)}}" class="btn btn-primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Add images</a>

            @endif
        </div>
    </div>
    <book-reader pdfurl="{{$pdfurl}}" :book="{{$book}}" shorturl="{{$shorturl}}"></book-reader>
</div>
@endsection