<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Vote - Elect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/shards/shards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shards/shards-extras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <style>
        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 5px solid #2fcc71;
        }

        [type=radio]:checked {
            content: "\2713";
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 100%;
            border: 2px solid #333;
            background-color: #2fcc71;
            z-index: 999;
            position: absolute;
            top: -10px;
            right: -10px;
        }

        .img-responsive {
            width: 100%;
            height: 180px;
            margin: 0 auto;
        }

        .section-break {
            border-bottom: 4px dotted black;
            margin-top: 10px;
        }

    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <header class="header text-center bg-primary p-3">
        <div class="institute-name">
            <h3 class="font-weight-bold my-0 text-light">{{ $institute->name }}</h3>
        </div>
        <div class="election-title mt-1">
            <h4 class="text-light my-0">{{ $election->title }}</h4>
        </div>
    </header>

    <form action="{{ route('frontend.elections.vote.caste', $election->slug) }}" method="post">
        @csrf
        @foreach($data as $position)
            <h5 class="mb-3 mt-4 font-weight-bold">{{ $position->title }} candidates</h5>
            <div class="form-row">
                @foreach($position->candidates as $candidate)
                    <div class="col-2 mb-1">
                        <label class="bg-white text-center" for="candidate-{{ $candidate->id }}">
                            <input type="radio" name="position-{{ $position->id }}" id="candidate-{{ $candidate->id }}"
                                   value="{{ $candidate->id }}">
                            <img class="img-responsive mb-3" src="{{ $candidate->image }}">
                            <span class="font-weight-bold">{{ $candidate->voter->name }}</span> <br>
                            <span>{{ $candidate->standard->name }}</span>
                        </label>
                    </div>
                    @if($loop->last)
                        <div class="col-2 mb-1">
                            <label class="bg-white text-center" for="nota-{{ $position->id }}">
                                <input type="radio" name="position-{{ $position->id }}" id="nota-{{ $position->id }}"
                                       value="0" checked>
                                <img class="img-responsive mb-3" src="/storage/images/candidates/nota.png">
                                <span class="font-weight-bold">NOTA</span><br>
                                <span class="text-hide">NOTA</span>
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
            @if(!$loop->last)
                <div class="section-break">

                </div>
            @endif
        @endforeach
        <div class="form-group">
            <button class="btn btn-lg btn-success mt-5 ">Caste Your Vote</button>
        </div>
    </form>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>