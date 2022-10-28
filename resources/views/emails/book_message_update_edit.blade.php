<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book message update or delete</title>
</head>

<body>
    <div>
        <p>Dear {{ $bookMessage->name }}, </p>
        <p>Your book message was successfully sent to this book. To edit or delete the message please use the link below.</p>
        <h3>
            Your Message
        </h3>
        <p>
            <i>
                "{{
                    $bookMessage->message
                }}"
            </i>
        </p>
        <h3>
            Book Details
        </h3>
        <strong>{{ $book->title }}</strong>
        <p>{{ $book->cover_message }}</p>

        <a class="btn" href="{{$link}}">Edit or Update message</a>

        <br>
        <p>Kind regards,</p>
        <p>MycelebrationBooks Team.</p>
    </div>
</body>

</html>