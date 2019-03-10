@extends('dashboard.layouts.master', ['selected_nav' => 'voters'])
@section('title')
    Edit voter
@endsection

@push('page-content-title')
    Voters
@endpush

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Voters</span>
            <h3 class="page-title">Edit Voter</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.voters.update', $voter->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nameInput">Full name</label>
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"
                                   name="name" id="nameInput" value="{{ $voter->name }}">
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
                                           value="{{ $voter->admission_number }}">
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
                                           value="{{ $voter->roll_number }}">
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
                                               {{ $voter->gender == 0 ? 'checked' : '' }} value="0"
                                               class="form-control custom-control-input">
                                        <label class="custom-control-label" for="maleRadioInput">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio d-inline">
                                        <input type="radio" id="femaleRadioInput" name="gender"
                                               {{ $voter->gender == 1 ? 'checked' : '' }} value="1"
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
                                               value="{{ date('Y-m-d', strtotime($voter->birth_date))  }}"
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
                                    <option value="{{ $standard->id }}" {{ $voter->standard_id == $standard->id ? 'selected': '' }}>
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

                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
