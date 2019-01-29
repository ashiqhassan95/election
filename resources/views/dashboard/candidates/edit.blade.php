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
        <div class="col-lg-6 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.candidates.update', $candidate->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nameInput">Full name</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   id="nameInput" name="name" value="{{ $candidate->name }}">
                            @foreach($errors->get('name') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="admissionInput">Admission number</label>
                                    <input class="form-control{{ $errors->has('admission_number') ? ' is-invalid' : '' }}"
                                           type="text" name="admission_number" id="admissionInput"
                                           value="{{ $candidate->admission_number }}">
                                    @foreach($errors->get('admission_number') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="rollInput">Roll number</label>
                                    <input class="form-control{{ $errors->has('roll_number') ? ' is-invalid' : '' }}"
                                           type="text" name="roll_number" id="rollInput"
                                           value="{{ $candidate->roll_number }}">
                                    @foreach($errors->get('roll_number') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label for="gender">Gender</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio d-inline mr-3">
                                        <input type="radio" id="maleRadioInput" name="gender"
                                               {{ $candidate->gender == 0 ? 'checked' : '' }} value="0"
                                               class="form-control custom-control-input">
                                        <label class="custom-control-label" for="maleRadioInput">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline">
                                        <input type="radio" id="femaleRadioInput" name="gender"
                                               {{ $candidate->gender == 1 ? 'checked' : '' }} value="1"
                                               class="form-control custom-control-input">
                                        <label class="custom-control-label" for="femaleRadioInput">Female</label>
                                    </div>

                                    <div class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }} d-none"></div>
                                    @foreach($errors->get('gender') as $error)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="birthDate">Date of birth</label>
                                    <div class="input-group">
                                        <input class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                               type="text" name="birth_date" id="birthDate"
                                               value="{{ date('Y-m-d', strtotime($candidate->birth_date))  }}"
                                               data-provide="datepicker" autocomplete="off" data-date-format="yyyy-mm-dd">
                                        <span class="input-group-append">
                                            <span class="input-group-text">
                                              <i class="material-icons">&#xE916;</i>
                                            </span>
                                        </span>
                                        @foreach($errors->get('birth_date') as $error)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $error }}</strong>
                                            </span>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="standardSelect">Select a standard</label>
                            <select class="form-control{{ $errors->has('standard_id') ? ' is-invalid' : '' }}"
                                    name="standard_id" id="standardSelect">
                                @foreach($standards as $standard)
                                    <option value="{{ $standard->id }}" {{ $candidate->standard_id == $standard->id ? 'selected': '' }}>
                                        {{ $standard->name }}
                                    </option>
                                @endforeach
                            </select>
                            @foreach($errors->get('standard_id') as $error)
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="electionSelect">Select a election</label>
                            <select class="form-control{{ $errors->has('standard_id') ? ' is-invalid' : '' }}"
                                    name="election_id" id="electionSelect">
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected': '' }}>
                                        {{ $election->title }}
                                    </option>
                                @endforeach
                                @foreach($errors->get('election_id') as $error)
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="positionSelect">Select a position</label>
                            <select class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}"
                                    name="position_id" id="positionSelect">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ $candidate->position_id == $position->id ? 'selected': '' }}>
                                        {{ $position->title }}
                                    </option>
                                @endforeach
                                @foreach($errors->get('position_id') as $error)
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Position Form -->
        </div>
    </div>
@endsection