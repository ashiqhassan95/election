@extends('auth.layouts.master')
@section('title')
    Reset password
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

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <img class="auth-form__logo d-table mx-auto mb-3"
                                         src="/images/shards/shards-dashboards-logo.svg"
                                         alt="Shards Dashboards - Register Template">
                                    <h5 class="auth-form__title text-center mb-4">Reset Password</h5>
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="form-group mb-4">
                                            <label for="emailInput">Email address @required</label>
                                            <input type="email" name="email"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   id="emailInput"
                                                   aria-describedby="emailHelp" placeholder="Enter email"
                                                   value="{{ old('email') }}">
                                            <small id="emailHelp" class="form-text text-muted text-center">You will
                                                receive an email with a unique token.
                                            </small>

                                            @foreach ($errors->get('email') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Send
                                            Password Reset Link
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="auth-form__meta d-flex mt-4">
                                <a class="mx-auto" href="{{ route('login') }}">Take me back to login.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection