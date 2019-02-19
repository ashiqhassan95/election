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
                                    <h4 class="auth-form__title text-center mb-4">{{ $institute->name }}</h4>
                                    <form action="/election/{{ $election['slug'] }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="uidInput">Enter UID</label>
                                            <input type="text" name="uid"
                                                   class="form-control{{ $errors->has('uid') ? ' is-invalid' : '' }}"
                                                   id="uidInput" required
                                                   value="{{ old('uid') }}"
                                                   placeholder="Enter Unique Identification Number" autofocus>
                                            @foreach ($errors->get('uid') as $error)
                                                <span class="invalid-feedback font-weight-bold" role="alert">
                                                   {{ $error }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="form-group">
                                            <label for="birthDate">Date of birth</label>
                                            <div class="input-group">
                                                <input class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                                       type="text" name="birth_date" id="birthDate"
                                                       value="{{ old('birth_date') }}" data-provide="datepicker"
                                                       autocomplete="off" placeholder="YYYY-MM-DD"  required
                                                       data-date-format="yyyy-mm-dd">
                                                <span class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="material-icons">&#xE916;</i>
                                                    </span>
                                                </span>
                                                @foreach($errors->get('birth_date') as $error)
                                                    <span class="invalid-feedback font-weight-bold" role="alert">
                                                        {{ $error }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @if($errors->any())
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach($errors->all() as $error)
                                                        <li class="text-danger font-weight-bold">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <button type="submit" class="btn btn-pill btn-accent d-table mx-auto">Login
                                        </button>
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
@push('js-body')
    <script></script>
@endpush