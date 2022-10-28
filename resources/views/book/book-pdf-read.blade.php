@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row mb-3 mt-0 pt-0">
        <div class="col-md-6 add_msg_cta_bar w-100">
            @if($book->user_id != Auth::id())

            @if($book->accepting_message)
            <a href="{{route('book-message', $book->id)}}" class="btn btn-info me-4">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                Add message</a>
            @endif

            <a href="{{route('book-images', $book->id)}}" class="btn btn-primary">
                <i class="fa fa-image" aria-hidden="true"></i>
                Add images</a>

            @endif
        </div>
    </div>
    <div class="mt-0 pt-0">
        <book-reader pdfurl="{{$pdfurl}}" :book="{{$book}}" :userid="{{Auth::id() ?? 0}}" shorturl="{{$shorturl}}"></book-reader>
    </div>
</div>
@endsection