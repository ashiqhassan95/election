@extends('dashboard.layouts.master', ['selected_nav' => 'institutes'])
@section('title')
    Create institute
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Institute</span>
            <h3 class="page-title">Add New Institute</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.institutes.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nameInput">Title</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   id="nameInput" name="name"
                                   value="{{ old('name') }}">
                            @foreach($errors->get('name') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="descriptionInput">Description</label>
                            <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                   id="descriptionInput" name="description"
                                   value="{{ old('description') }}">
                            @foreach($errors->get('description') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="addressInput">Address</label>
                            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                   id="addressInput" name="address"
                                   value="{{ old('address') }}">
                            @foreach($errors->get('address') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cityInput">City</label>
                                    <input type="text"
                                           class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                           id="cityInput" name="city"
                                           value="{{ old('city') }}">
                                    @foreach($errors->get('city') as $error)
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="stateInput">State</label>
                                    <input type="text"
                                           class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}"
                                           id="stateInput" name="state"
                                           value="{{ old('state') }}">
                                    @foreach($errors->get('name') as $error)
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="countryInput">Country</label>
                            <input type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                   id="countryInput" name="country"
                                   value="{{ old('country') }}">
                            @foreach($errors->get('country') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection