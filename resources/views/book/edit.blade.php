@extends('layouts.app')
@section('content')
<div class="book-edit">
    @if($content)
    <edit-book-content-component :book="{{$book}}" :content="{{$content}}" />
    @else 
    <edit-book-content-component :book="{{$book}}" />
    @endif
</div>
@endsection