<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - CVS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/shards/shards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/shards-extras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
<header class="bg-dark">
    <div class="container">
        @include('frontend.partials.frontend-nav')
    </div>
</header>

@yield('content')


@include('frontend.partials.frontend-footer')

<!-- JavaScript Dependencies -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('js-body')
</body>
</html>