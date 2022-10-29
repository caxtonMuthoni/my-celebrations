<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Image update or delete</title>
</head>

<body>
    <div>
        <p>Dear {{ $bookImage->name }}, </p>
        <p>Your book image was successfully sent to this book. To edit or delete the image please use the link below.</p>
        <h3>
            Your Image
        </h3>
       <div>
          <img src="{{$bookImage->image}}" alt="Book Image" style="height: 350px;">
       </div>
        <h3>
            Book Details
        </h3>
        <strong>{{ $book->title }}</strong>
        <p>{{ $book->cover_message }}</p>

        <a class="btn" href="{{$link}}">Edit or Update image</a>

        <br>
        <p>Kind regards,</p>
        <p>MycelebrationBooks Team.</p>
    </div>
</body>

</html>