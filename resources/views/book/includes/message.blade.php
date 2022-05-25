<link rel="stylesheet" href="{{asset('css/dev/message/template1/index.css')}}" media="all">
<div class="book__messages--container">
    <p class="book__messages--message">
        {{$message->message}}
    <div class="book__messages--cta">
        <span>{{$message->relationship}}, </span>
        <span>{{$message->user->name}}</span>
    </div>
    </p>
</div>