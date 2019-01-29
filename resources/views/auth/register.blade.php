@extends('auth.layouts.master')
@section('title')
    Register
@endsection

@push('css-head')
    <style>
        form button {
            min-width: 100px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100">
            <main class="main-content col">
                <div class="main-content-container container-fluid px-4 my-auto h-100">
                    <div class="row no-gutters h-100">
                        <div class="col col-md-4 auth-form mx-auto my-auto">
                            <div class="card mt-4 mb-4">
                                <div class="card-body">
                                    <img class="auth-form__logo d-table mx-auto mb-3"
                                         src="/images/shards/shards-dashboards-logo.svg"
                                         alt="Shards Dashboards - Register Template">
                                    <h5 class="auth-form__title text-center mb-1 display-4">Register New Account</h5>
                                    <h6 class="auth-form__meta text-center mb-4 text-primary font-weight-bold"
                                        style="font-size: 13px">
                                        No Credit Card Required
                                    </h6>
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nameInput">Name</label>
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   type="text" name="name" id="nameInput"
                                                   placeholder="First and last name" value="{{ old('name') }}">

                                            @foreach ($errors->get('name') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="emailInput">Email</label>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   type="email" name="email" id="emailInput"
                                                   placeholder="Yor email address" value="{{ old('email') }}">

                                            @foreach ($errors->get('email') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="passwordInput">Password</label>
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   type="password" name="password"
                                                   id="passwordInput"
                                                   aria-describedby="passwordHelp"
                                                   placeholder="password">
                                            <small id="passwordHelp" class="form-text text-muted">
                                                <i class="material-icons">lock</i> Password must be at least 6
                                                characters long
                                            </small>

                                            @foreach ($errors->get('password') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="passwordConfirm">Re enter Password</label>
                                            <input class="form-control" type="password" name="password_confirmation"
                                                   id="passwordConfirm" placeholder="Re enter Password">
                                        </div>

                                        <div class="form-group">
                                            <label for="instituteInput">Institute name</label>
                                            <input class="form-control{{ $errors->has('institute') ? ' is-invalid' : '' }}"
                                                   type="text" name="institute" id="instituteInput"
                                                   placeholder="Institute name" value="{{ old('institute') }}">

                                            @foreach ($errors->get('institute') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="countryInput">Country</label>
                                            <select class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                                    name="country" id="countryInput">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->code }}" {{ old('country') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>

                                            @foreach ($errors->get('country') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Register
                                        </button>

                                        <div class="mt-2 text-center small">
                                            By Registering you agree to our <a href="#">Terms & Conditions</a>
                                        </div>

                                    </form>
                                </div>
                                <div class="card-footer border-top bg-card-footer">
                                    <div class="text-center">
                                        Already have an account? <a class="ml-auto" href="{{ route('login') }}">Login to
                                            your account</a>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="auth-form__meta d-flex mt-4 mb-4">--}}
                            {{--<a href="{{route('password.request')}}">Forgot your password?</a>--}}
                            {{--<a class="ml-auto" href="{{ route('login') }}">Sign In?</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection