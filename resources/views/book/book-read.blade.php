@extends('layouts.app')
@section('content')
<div class="book-edit container">
    <div class="bg-white p-5">
        <h2>{{$book->title}}</h2>
        <h4> {{$book->cover_message}}</h4>
    </div>
    <div class="bg-white p-5">
        {!! $book->content->content !!}
    </div>
</div>
@endsection