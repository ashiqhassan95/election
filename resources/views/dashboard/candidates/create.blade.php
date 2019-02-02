@extends('dashboard.layouts.master', ['selected_nav' => 'candidates'])
@section('title')
    Create candidate
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="row page-header no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Candidates</span>
            <h3 class="page-title">Add New Candidate</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-7 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.candidates.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="voter_id" value="{{ $voter->id }}">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td class="w-30">Name</td>
                                <td>{{ $voter->name }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Gender</td>
                                <td>{{ $voter->gender() }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Date of Birth</td>
                                <td>{{ $voter->birth_date }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Admission Number</td>
                                <td>{{ $voter->admission_number }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Roll Number</td>
                                <td>{{ $voter->roll_number }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Class</td>
                                <td>{{ $voter->standard->name }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <label for="imageInput" class="mb-0">Image</label>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="imageInput" name="image"
                                                   class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }} custom-file-input">
                                            <label class="custom-file-label overflow-hidden" for="imageInput">Choose
                                                file...</label>
                                        </div>
                                        <div class="input input-group-append">
                                            <button class="btn btn-warning ml-1 js-clear-image-btn" href="#">Clear
                                            </button>
                                        </div>

                                    </div>
                                    <div class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }} d-none"></div>
                                    @foreach($errors->get('image') as $error)
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30 border-right">
                                    <label for="electionSelect" class="mb-0">Select election</label>
                                </td>
                                <td>
                                    <select class="form-control{{ $errors->has('election_id') ? ' is-invalid' : '' }}"
                                            name="election_id" id="electionSelect">
                                        @foreach($elections as $election)
                                            <option value="{{ $election->id }}" {{ old('election_id') == $election->id ? 'selected': '' }}>
                                                {{ $election->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @foreach($errors->get('election_id') as $error)
                                        <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30 border-right">
                                    <label for="positionSelect" class="mb-0">Select position</label>
                                </td>
                                <td>
                                    <select class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}"
                                            name="position_id" id="positionSelect">
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected': '' }}>
                                                {{ $position->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @foreach($errors->get('position_id') as $error)
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Position Form -->
        </div>
    </div>
@endsection
