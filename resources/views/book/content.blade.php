@extends('layouts.app')
@section('content')

<div class="book-content">
    <book-content-component :book="{{$book}}" :bookid="{{$id}}" />
</div>
@endsection