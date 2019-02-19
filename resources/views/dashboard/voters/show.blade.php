@extends('dashboard.layouts.master', ['selected_nav' => 'voters'])
@section('title')
    Show voter
@endsection

@section('content')
    <div class="row page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Voters</span>
            <h3 class="page-title">Voter details</h3>
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
                <div class="card-body border-bottom">
                    <div class="entity-details">
                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Full name</span>
                                <span>{{ $voter->name }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Admission #</span>
                                <span>{{ $voter->admission_number }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Roll #</span>
                                <span>{{ $voter->roll_number }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Standard</span>
                                <span>
                                    <a href="{{ route('dashboard.standards.show',  $voter->standard->getKey()) }}">
                                        {{ $voter->standard->name }}
                                    </a>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Gender</span>
                                <span>{{ $voter->gender() }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Date of Birth</span>
                                <span>{{ $voter->birth_date }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Created at</span>
                                <span>{{ $voter->created_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Updated at</span>
                                <span>{{ $voter->updated_at }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <span>UID</span>
                                <span>{{ $voter->uid }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">

                            <form id="delete-form"
                                  action="{{ route('dashboard.voters.destroy', $voter->getKey()) }}"
                                  method="post">
                                @csrf
                                @method('delete')
                            </form>

                            <form id="candidate-form" action="{{ route('dashboard.candidates.create')}}">
                                @csrf
                                @method('post')
                                <input type="hidden" name="voter_id" value="{{ $voter->getKey() }}">
                            </form>

                            <div class="btn-group">
                                <a class="btn btn-outline-primary"
                                   onclick="document.getElementById('candidate-form').submit()"
                                   href="javascript:;">Make it as candidate</a>

                                <a class="btn btn-outline-primary"
                                   href="{{ route('dashboard.voters.edit', $voter->getKey()) }}">Edit</a>

                                <a class="btn btn-outline-danger"
                                   onclick="document.getElementById('delete-form').submit()"
                                   href="javascript:;">Delete</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection