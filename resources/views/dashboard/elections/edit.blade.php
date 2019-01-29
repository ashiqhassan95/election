@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Edit election
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Edit Election</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.elections.update', $election->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text"
                                   name="title" id="titleInput" value="{{ $election->title }}">
                            @foreach($errors->get('title') as $error)
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                            @endforeach
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="academicStartYearDate">Academic start year</label>
                                    <input class="form-control{{ $errors->has('academic_start_year') ? ' is-invalid' : '' }}"
                                           type="date" name="academic_start_year"
                                           id="academicStartYearDate"
                                           value="{{ $election->academic_start_year }}">
                                    @foreach($errors->get('academic_start_year') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="academicEndYearDate">Academic end year</label>
                                    <input class="form-control{{ $errors->has('academic_end_year') ? ' is-invalid' : '' }}"
                                           type="date" name="academic_end_year"
                                           id="academicEndYearDate"
                                           value="{{ $election->academic_end_year }}">
                                    @foreach($errors->get('academic_end_year') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="pollStartDateTime">Poll start date time</label>
                                    <input class="form-control{{ $errors->has('poll_start_date_time') ? ' is-invalid' : '' }}"
                                           type="datetime-local" name="poll_start_date_time"
                                           id="pollStartDateTime"
                                           value="{{ $election->poll_start_date_time }}" required>
                                    @foreach($errors->get('poll_start_date_time') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="pollEndDateTime">Poll end date time</label>
                                    <input class="form-control{{ $errors->has('poll_end_date_time') ? ' is-invalid' : '' }}"
                                           type="datetime-local" name="poll_end_date_time"
                                           id="pollEndDateTime"
                                           value="{{ $election->poll_end_date_time }}">
                                    @foreach($errors->get('poll_end_date_time') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Position Form -->
        </div>
    </div>
@endsection
