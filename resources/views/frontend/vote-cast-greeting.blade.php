<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Vote - Elect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<meta http-equiv="refresh" content="10;url={{ route('election.vote', $election->slug) }}">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/shards/shards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/shards-extras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <style>


    </style>
</head>
<body class="bg-light h-100">
<div class="container py-4 m-auto align-middle">
    <h3>Thank you for voting</h3>
    <h6>Redirect after <span id="countdown">10</span> seconds</h6>
</div>
{{--<script>--}}
    {{--setTimeout(function () {--}}
        {{--window.location.href = '{{ route('election.vote', $election->slug) }}';--}}
    {{--}, 10000);--}}
{{--</script>--}}

<script type="text/javascript">
    // Total seconds to wait
    var seconds = 10;

    function countdown() {
        seconds = seconds - 1;
        if (seconds < 0) {
            // Chnage your redirection link here
            window.location = "{{ route('election.vote', $election->slug) }}";
        } else {
            // Update remaining seconds
            document.getElementById("countdown").innerHTML = seconds;
            // Count down using javascript
            window.setTimeout("countdown()", 1000);
        }
    }
    // Run countdown function
    countdown();
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>