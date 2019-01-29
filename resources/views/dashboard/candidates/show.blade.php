@extends('dashboard.layouts.master', ['selected_nav' => 'candidates'])
@section('title')
    Show Candidate
@endsection

@section('content')
    <div class="row page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Candidates</span>
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
    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-header text-center border-bottom bg-light">
                    <div class="mb-2">
                        <img src="/images/shards/avatars/1.jpg" class="rounded-circle" width="130" alt="Profile image">
                    </div>
                    <h4 class="mb-0">{{ $candidate->name }}</h4>
                </div>
                <div class="card-body border-bottom">
                    <div class="entity-details">
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Admission #</span>
                                <span>{{ $candidate->admission_number }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Roll #</span>
                                <span>{{ $candidate->roll_number }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Gender</span>
                                <span>{{ $candidate->gender() }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Date of Birth</span>
                                <span>{{ $candidate->birth_date }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Standard</span>
                                <span>{{ $candidate->standard->name }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Position</span>
                                <span>{{ $candidate->position->title }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Created at</span>
                                <span>{{ $candidate->created_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Updated at</span>
                                <span>{{ $candidate->updated_at }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col w-50">
                                <span>Created by</span>
                                <span>{{ $candidate->user->name ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-light">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mr-1"
                               href="{{ route('dashboard.candidates.edit', $candidate->getKey()) }}">Edit</a>

                            <a class="btn btn-danger"
                               href="{{ route('dashboard.candidates.destroy', $candidate->getKey()) }}">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection