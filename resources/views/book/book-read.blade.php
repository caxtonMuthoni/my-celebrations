@extends('layouts.app')
@section('content')
<div class="book-read">
    <div class="container">
        <div class="text-right book-read__cta my-2">
            <button onclick="expandScreen()" id="expandButton" class="btn btn-secondary me-2"> <i class="fa fa-expand me-2" aria-hidden="true"></i> Full screen</button>
            <a href="{{route('book-message', $id)}}" class="btn btn-info me-4">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                Add message</a>

            <a href="{{route('book-images', $id)}}" class="btn btn-primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Add images</a>
        </div>
    </div>
    <div id="mybook" class="container px-5" style="height: 100%; min-height:500px;">
        <iframe class="bg-white" width="100%" style="min-height:500px;" height="100%" src="{{$book->template->template_url . '?id='.$id}}" frameborder="0"></iframe>
    </div>
</div>

@endsection