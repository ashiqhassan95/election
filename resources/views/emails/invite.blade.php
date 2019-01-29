<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .button {
            color: #fff !important;
            text-decoration: none;
            background: #4169ed;
            padding: 5px;
            border-radius: 5px;
            display: inline-block;
            border: none;
        }
    </style>
</head>
<body>
<p>Hi,</p>

<p>{{ $invite->user->name }} has invited you to join Elect.</p>

<a class="button" href="{{ route('invite.accept', $invite->token) }}">Click here</a> to activate!
</body>
</html>