@extends('dashboard.layouts.master', ['selected_nav' => 'candidates'])
@section('title')
    Show Candidate
@endsection

@push('page-content-title')
    Candidates
@endpush

@section('content')
    <div class="row page-header row no-gutters py-4">
        <div class="col mb-0">
            <h3 class="page-title">Candidate details</h3>
        </div>
    </div>

    @push('css-head')
        <style>
            .entity-details .col span {
                display: block;
            }

            .entity-details .col span:last-child {
                font-weight: bold;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-header text-center border-bottom bg-light">
                    <div class="mb-2">
                        <img src="{{ $candidate->image }}" class="rounded-circle" width="130" alt="Profile image">
                    </div>
                    <h4 class="mb-0">{{ $candidate->voter->name }}</h4>
                </div>
                <div class="card-body border-bottom">
                    <div class="entity-details">
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Full name</span>
                                <span>{{ $candidate->voter->name }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Admission #</span>
                                <span>{{ $candidate->voter->admission_number }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Roll #</span>
                                <span>{{ $candidate->voter->roll_number }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Standard</span>
                                <span>
                                    <a href="{{ route('dashboard.standards.show',  $candidate->standard->getKey()) }}">
                                        {{ $candidate->standard->name }}
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Gender</span>
                                <span>{{ $candidate->voter->gender() }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Date of Birth</span>
                                <span>{{ $candidate->voter->birth_date }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Election</span>
                                <span>
                                    <a href="{{ route('dashboard.elections.show',  $candidate->election->getKey()) }}">
                                        {{ $candidate->election->title }}
                                    </a>
                                </span>
                            </div>
                            <div class="col w-50">
                                <span>Position</span>
                                <span>
                                    <a href="{{ route('dashboard.positions.show',  $candidate->position->getKey()) }}">
                                        {{ $candidate->position->title }}
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col w-50">
                                <span>Created at</span>
                                <span>{{ $candidate->created_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Updated at</span>
                                <span>{{ $candidate->updated_at }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                @if($candidate->election->status == 0)
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col">
                                <form id="delete-form"
                                      action="{{ route('dashboard.candidates.destroy', $candidate->getKey()) }}"
                                      method="post">
                                    @csrf
                                    @method('delete')
                                </form>

                                <div class="btn-group">
                                    <a class="btn btn-outline-primary"
                                       href="{{ route('dashboard.candidates.edit', $candidate->getKey()) }}">Edit</a>

                                    <a class="btn btn-outline-danger"
                                       onclick="document.getElementById('delete-form').submit()"
                                       href="javascript:;">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection