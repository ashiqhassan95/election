<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @stack('js-head')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/shards-dashboards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/shards-extras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @stack('css-head')
</head>
<body class="h-100">
<div class="container-fluid">
    <div class="row">

        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            @include('dashboard.partials.dashboard-sidebar')
        </aside>

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            @include('dashboard.partials.dashboard-top-bar')
            @yield('message')
            <div class="main-content-container container-fluid px-4">
                @yield('content')
            </div>
            @include('dashboard.partials.dashboard-footer')
        </main>

    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/site.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="{{ asset('js/shards/shards.min.js') }}"></script>

<script src="{{ asset('js/shards/extras.min.js') }}"></script>
<script src="{{ asset('js/shards/shards-dashboards.min.js') }}"></script>
@stack('js-body')
</body>
</html>