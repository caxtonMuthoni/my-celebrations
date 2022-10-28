@extends('layouts.app')
@section('content')
<div class="book-message container">
    <div class="row">
        <div class="col-md-12 text-center">
            <update-book-message-component :book-id="{{$id}}" :message="{{$bookMessage}}" />
        </div>
    </div>
</div>
@endsection