@extends('layouts.app')
@section('content')
<div class="book-message container">
    <div class="row">
        <div class="col-md-12 text-center">
            <add-book-message-component :book-id="{{$id}}" />
        </div>
    </div>
</div>
@endsection