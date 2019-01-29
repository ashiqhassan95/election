<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - Elect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/shards-dashboards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/extras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @stack('css-head')
</head>
<body class="h-100">
@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/shards/shards.min.js') }}"></script>
<script src="{{ asset('js/shards/extras.min.js') }}"></script>
<script src="{{ asset('js/shards/shards-dashboards.min.js') }}"></script>
@stack('js-body')
</body>
</html>