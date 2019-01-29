@extends('auth.layouts.master')
@section('title')
    Join
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
                            <div class="card my-4">
                                <div class="card-body">
                                    <img class="auth-form__logo d-table mx-auto mb-3"
                                         src="/images/shards/shards-dashboards-logo.svg"
                                         alt="Shards Dashboards - Register Template">
                                    <h5 class="auth-form__title text-center mb-4">Join the Elect</h5>
                                    <form action="{{ route('invite.register') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $invite->token }}">

                                        <div class="form-group">
                                            <label for="nameInput">Name</label>
                                            <input id="nameInput" type="text"
                                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" value="{{ old('name') }}">

                                            @foreach ($errors->get('name') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="emailInput">Email</label>
                                            <input id="emailInput" type="email" class="form-control" name="email"
                                                   value="{{ $invite->email }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwordInput">Password</label>
                                            <input type="password" name="password"
                                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   id="passwordInput" placeholder="Password">

                                            @foreach ($errors->get('password') as $error)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $error }}</strong>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="passwordConfirmInput">Repeat Password</label>
                                            <input type="password" class="form-control" id="passwordConfirmInput"
                                                   name="password_confirmation" placeholder="Repeat Password">
                                        </div>

                                        <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">
                                            Join now
                                        </button>

                                        <div class="mt-2 text-center small">
                                            By clicking Create account, you agree to our <a href="#">Terms & Conditions</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection