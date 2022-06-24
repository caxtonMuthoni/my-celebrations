<!DOCTYPE html>
<html>

<head>
    <title>Contact Form</title>
</head>

<body>
    <h1>{{ $msg['reason'] }}</h1>
    <p>Name: <b>{{ $msg['name'] }}</b></p>
    <p>Phone Number: <b>{{ $msg['phone_number'] }}</b></p>
    <p>Email Address: <b>{{ $msg['email'] }}</b></p>

    <p>
        {{ $msg['message'] }}
    </p>


    <p>Thank you</p>
</body>

</html>