<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{public_path() . $book->template->template_url . '/index.css'}}" media="all">
    <link rel="stylesheet" href="{{public_path() . '/css/dev/message/template1/index.css'}}" media="all">
    <title>{{$book->title}}</title>
    <style>
        .new-page {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="book container">
        <div class="book__cover-page">
            <div class="book__image">
                <img src="{{public_path() . substr($book->image, strlen(env('APP_URL')))}}" alt="" class="book__image--photo">
            </div>
            <h1 class="book__title">{{$book->title}} Endless</h1>
            <h5 class="book__cover-message">
                {{$book->cover_message}}
            </h5>
        </div>
        <div class="new-page"></div>
        <div class="book__content">
            {!! $book->content->content !!}
        </div>
        @if(count($book->bookImages) > 0)
        <div class="new-page"></div>
        <div class="book__images">
            <h2 class="book__images--title">Book Gallery</h2>
            @foreach($book->bookImages as $image)
            <div class="book__images--image" style="margin-bottom: 30px;">
                <img src="{{public_path() . substr($image->image, strlen(env('APP_URL')))}}" alt="" class="book__images--photo">
                 <caption>{{$image->caption}}</caption>
            </div>
            @endforeach
        </div>
        @endif
        @if(count($book->bookMessages) > 0)
        <div class="new-page"></div>
        <div class="book__messages">
            <h2 class="book__messages--title">Book messages</h2>
            @foreach($book->bookMessages as $message)
            <div class="book__messages--container">
                <p class="book__messages--message">
                    {{$message->message}}
                <div class="book__messages--cta">
                    <span>{{$message->relationship}}, </span>
                    <span>{{$message->user->name}}</span>
                </div>
                </p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</body>

</html>