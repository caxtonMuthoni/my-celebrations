<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book transfer</title>
</head>

<body>
    <div>
        <p>Dear {{ $user->name }}, </p>
        <p>This book has been transfered to you</p>
        <strong>{{ $book->title }}</strong>
        <p>{{ $book->cover_message }}</p>
        <p>
            By clicking the button below, the book will be added to your Account.</p>
        <a class="btn" href="{{route('accept_book_transfer', $token)}}">Accept</a>

        <br>
        <p>Kind regards,</p>
        <p>MycelebrationBooks Team.</p>
    </div>
</body>

</html>