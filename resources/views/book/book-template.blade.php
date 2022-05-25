<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{$book->template->template_url . '/index.css'}}" media="all">
    <!-- <link rel="stylesheet" href="{{asset('css/dev/message/template1/index.css')}}" media="all"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>{{$book->title}}</title>
    <style>
        @page {
            /* header: page-header;
            footer: page-footer; */
        }
    </style>
</head>

<body>
    <div class="book container">
        <div class="book__cover-page">
                <div class="book__image">
                    <img src="{{$book->image}}" alt="" class="book__image--photo">
                </div>
                <h1 class="book__title">{{$book->title}}</h1>
                <h5 class="book__cover-message">
                    {{$book->cover_message}}
                </h5>
        </div>
        <div class="book__content">
            {!! $book->content->content !!}
        </div>
        <div class="book__images mt-5">
            <h2 class="book__images--title">Book Gallery</h2>
            @foreach($book->bookImages as $image)
            <div class="book__images--image" style="margin-bottom: 30px;">
                <img src="{{$image->image}}" alt="" class="book__images--photo">
                <caption>{{$image->caption}}</caption>
            </div>
            @endforeach
        </div>
        <div class="book__messages">
            <h2 class="book__messages--title">Book messages</h2>
            @foreach($book->bookMessages as $message)
              @include('book.includes.message', ['message' => $message])
            @endforeach
        </div>
    </div>
</body>

</html>