@extends('dashboard.layouts.master', ['selected_nav' => 'settings.institute'])
@section('title')
    Institute Settings
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mt-4">
            <!-- Edit User Details Card -->
            <div class="card card-small edit-user-details mb-4">
                <div class="card-header p-0">
                    <div class="border-bottom clearfix d-flex">
                        @include('dashboard.partials.dashboard-settings-nav-tab', ['selected_nav'=> 'settings.institute'])
                    </div>
                </div>
                <div class="card-body">
                    <form action="#">

                        <div class="form-row">
                            <div class="col mb-3">
                                <h6 class="form-text m-0">Institute</h6>
                                <strong class="form-text text-muted m-0">Change your institute details.</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nameInput">Institute name</label>
                            <input class="form-control{{ $errors->has('institute') ? ' is-invalid' : '' }}"
                                   type="text" name="institute" id="nameInput"
                                   placeholder="Institute name" value="{{ $institute->name }}">
                            <small class="form-text text-muted">The institute name will be displayed to voters when
                                logging in and voting in your elections.
                            </small>
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
                                    <option value="{{ $country->code }}" {{ $institute->country == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @foreach ($errors->get('country') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="card-footer border-top">
                    <a href="#" class="btn btn-sm btn-accent ml-auto d-table mr-3">Save Changes</a>
                </div>
            </div>
            <!-- End Edit User Details Card -->
        </div>
    </div>
@endsection