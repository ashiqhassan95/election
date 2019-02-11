<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidates</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            color: #333;
            background-color: #eee;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 200;
        }

        h1 {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #2fcc71;
            max-width: 40%;
            margin: 20px auto;
        }

        /* CONTAINERS */

        .container {
            max-width: 850px;
            width: 100%;
            margin: 0 auto;
        }

        .four {
            width: 32.26%;
            max-width: 32.26%;
        }

        /* COLUMNS */

        .col {
            display: block;
            float: left;
            margin: 1% 0 1% 1.6%;
        }

        .col:first-of-type {
            margin-left: 0;
        }

        /* CLEARFIX */

        .cf:before,
        .cf:after {
            content: " ";
            display: table;
        }

        .cf:after {
            clear: both;
        }

        .cf {
            *zoom: 1;
        }

        /* FORM */

        .form .plan input, .form .payment-plan input, .form .payment-type input {
            display: none;
        }

        .form label {
            position: relative;
            background-color: #aaa;
            /*font-size: 26px;*/
            text-align: center;
            /*height: 120px;*/
            /*line-height: 120px;*/
            display: block;
            cursor: pointer;
            border: 3px solid transparent;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form .plan input:checked + label, .form .payment-plan input:checked + label, .form .payment-type input:checked + label {
            border: 3px solid #333;
            background-color: #2fcc71;
        }

        .form .plan input:checked + label:after, form .payment-plan input:checked + label:after, .form .payment-type input:checked + label:after {
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

        .submit {
            padding: 15px 60px;
            display: inline-block;
            border: none;
            margin: 20px 0;
            background-color: #2fcc71;
            color: #fff;
            border: 2px solid #333;
            font-size: 18px;
            -webkit-transition: transform 0.3s ease-in-out;
            -o-transition: transform 0.3s ease-in-out;
            transition: transform 0.3s ease-in-out;
        }

        .submit:hover {
            cursor: pointer;
            transform: rotateX(360deg);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Checkout Form</h1>
    <form class="form cf">
        @foreach($data as $position)
            <section class="plan cf">
                <h2>{{ $position->title }}</h2>
                <div class="d-flex align-content-start flex-wrap">
                    @foreach($position->candidates as $candidate)
                        <input type="radio" name="{{$position->id}}" id="{{$candidate->id}}" value="free">
                        <label class="free-label four col" for="{{$candidate->id}}">
                            <div class="card">
                                <div class="card-body p-1">
                                    <img width="100px" height="100px" src="{{ $candidate->image }}" alt="">
                                </div>
                                <div class="card-footer">
                                    <h5 class="m-1">{{ $candidate->voter->name }}</h5>
                                    <h6 class="m-0">{{ $candidate->standard->name }}</h6>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </section>
        @endforeach
        <input class="submit" type="submit" value="Submit">
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>