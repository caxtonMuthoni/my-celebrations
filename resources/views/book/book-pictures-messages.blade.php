@extends('layouts.app')
@section('content')

<div class="container">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="bookpicmessagestab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="message" aria-selected="true">Messages</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="picture-tab" data-bs-toggle="tab" data-bs-target="#picture" type="button" role="tab" aria-controls="picture" aria-selected="false">Pictures</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="message" role="tabpanel" aria-labelledby="message-tab">
            <book-messages-component :messages="{{$messages}}" />
        </div>
        <div class="tab-pane" id="picture" role="tabpanel" aria-labelledby="picture-tab">
            <book-pictures-component :pictures="{{$pictures}}"/>
        </div>
    </div>
</div>
@endsection