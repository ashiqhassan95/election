@extends('dashboard.layouts.master', ['selected_nav' => 'candidates'])
@section('title')
    Edit candidate
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Candidates</span>
            <h3 class="page-title">Edit Candidate</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-7 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.candidates.update', $candidate->getKey()) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td class="w-30">Name</td>
                                <td>{{ $candidate->voter->name }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Gender</td>
                                <td>{{ $candidate->voter->gender() }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Date of Birth</td>
                                <td>{{ $candidate->voter->birth_date }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Admission Number</td>
                                <td>{{ $candidate->voter->admission_number }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Roll Number</td>
                                <td>{{ $candidate->voter->roll_number }}</td>
                            </tr>
                            <tr>
                                <td class="w-30">Class</td>
                                <td>{{ $candidate->voter->standard->name }}</td>
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
                                            <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected': '' }}>
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
                                            <option value="{{ $position->id }}" {{ $candidate->position_id == $position->id ? 'selected': '' }}>
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