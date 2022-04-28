@extends('layouts.app')
@section('content')
<div class="book-read">
    <div class="container">
        <div class="text-right book-read__cta my-2">
            <button onclick="expandScreen()" id="expandButton" class="btn btn-secondary me-2"> <i class="fa fa-expand me-2" aria-hidden="true"></i> Full screen</button>

            @if($book->user_id != Auth::id())
            <a href="{{route('book-message', $id)}}" class="btn btn-info me-4">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                Add message</a>

            <a href="{{route('book-images', $id)}}" class="btn btn-primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Add images</a>

            @else
            <a href="{{route('book-show', $id)}}" class="btn btn-primary me-2">
                <i class="fa fa-edit me-2" aria-hidden="true"></i>
                Edit</a>
            @if(!$book->published)
            <a href="{{route('publish-book', $id)}}" class="btn btn__primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Publish</a>
            @else
            <a href="{{route('publish-book', $id)}}" class="btn btn-warning">
                <i class="fa fa-image" aria-hidden="true"></i>
                Switch to Draft</a>
            @endif
            @endif
        </div>
    </div>
    <div id="mybook" class="container px-5" style="height: 100%; min-height:500px;">
        <iframe class="bg-white" width="100%" style="min-height:500px;" height="100%" src="{{$book->template->template_url . '?id='.$id}}" frameborder="0"></iframe>
    </div>
</div>

@endsection