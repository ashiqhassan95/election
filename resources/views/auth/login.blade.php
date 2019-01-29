@extends('auth.layouts.master')
@section('title')
    Login
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
                            <div class="card">
                                <div class="card-body">
                                    <img class="auth-form__logo d-table mx-auto mb-3"
                                         src="/images/shards/shards-dashboards-logo.svg"
                                         alt="Shards Dashboards - Register Template">
                                    <h5 class="auth-form__title text-center mb-4">Login Your Account</h5>
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="emailInput">Email address</label>
                                            <input type="email" name="email"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="emailInput"
                                                   value="{{ old('email') }}" placeholder="Enter email" autofocus>

                                            @foreach ($errors->get('email') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="passwordInput">Password</label>
                                            <input type="password" name="password"
                                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   id="passwordInput"
                                                   placeholder="Password">

                                            @foreach ($errors->get('password') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group mb-3 d-table">
                                            <div class="custom-control custom-checkbox mb-1">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                       id="rememberCheckBox">
                                                <label class="custom-control-label" for="rememberCheckBox">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Login
                                        </button>
                                    </form>
                                </div>
                                <div class="card-footer bg-card-footer border-top">
                                    <div class="auth-form__meta d-flex">
                                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                                        <a class="ml-auto" href="{{ route('register') }}">Create new account?</a>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="auth-form__meta d-flex mt-4">--}}
                                {{--<a href="{{ route('password.request') }}">Forgot your password?</a>--}}
                                {{--<a class="ml-auto" href="{{ route('register') }}">Create new account?</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection