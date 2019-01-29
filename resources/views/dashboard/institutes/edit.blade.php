@extends('dashboard.layouts.master', ['selected_nav' => 'institutes'])
@section('title')
    Edit institute
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Institute</span>
            <h3 class="page-title">Edit Institute</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Standard Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.institutes.update', $institute->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nameInput">Title</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   id="nameInput" name="name"
                                   value="{{  $institute->name }}">
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
                                   value="{{  $institute->description }}">
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
                                   value="{{  $institute->address }}">
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
                                           value="{{  $institute->city }}">
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
                                           value="{{  $institute->state }}">
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
                                   value="{{  $institute->country }}">
                            @foreach($errors->get('country') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Standard Form -->
        </div>
    </div>
@endsection