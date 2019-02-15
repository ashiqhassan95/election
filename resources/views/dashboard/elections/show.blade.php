@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Show election
@endsection

@section('content')
    <div class="row page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Election details</h3>
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
                            <div class="col">
                                <span>Title</span>
                                <span>{{ $election->title }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Poll started at</span>
                                <span>{{ $election->poll_start_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Poll ended at</span>
                                <span>{{ $election->poll_end_at }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Poll started at</span>
                                <span>{{ $election->poll_start_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Poll ended at</span>
                                <span>{{ $election->poll_end_at }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Created at</span>
                                <span>{{ $position->created_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Updated at</span>
                                <span>{{ $position->updated_at }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">
                            <form id="delete-form"
                                  action="{{ route('dashboard.positions.destroy', $position->getKey()) }}"
                                  method="post">
                                @csrf
                                @method('delete')
                            </form>

                            <div class="btn-group">
                                <a class="btn btn-outline-primary"
                                   href="{{ route('dashboard.positions.edit', $position->getKey()) }}">Edit</a>

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

@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Election details
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Election details</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <table class="table table-striped mb-0">
                        <tbody>
                        <tr>
                            <td><strong>Title</strong></td>
                            <td>{{ $election->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Polling start at</strong></td>
                            <td>{{ $election->poll_start_at ?? 'NIL' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Polling end at</strong></td>
                            <td>{{ $election->poll_end_at ?? 'NIL' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Type of election</strong></td>
                            <td>{{ $election->getType() }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                @if($election['status'] == 0)
                                    <span class="text-accent">{{ $election->getStatus() }}</span>
                                @elseif($election['status'] == 1)
                                    <span class="text-success">{{ $election->getStatus() }}</span>
                                @elseif($election['status'] == 2)
                                    <span class="text-danger">{{ $election->getStatus() }}</span>
                                @endif
                            </td>
                        </tr>
                        @if($election['status'] == 1)
                            <tr>
                                <td><strong>Url</strong></td>
                                <td>
                                    <a href="{{ route('election.vote', $election['slug']) }}"
                                       target="_blank">{{ route('election.vote', $election['slug']) }}</a>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">
                            @if($election['status'] == 0)
                                <div class="btn-group" role="group">
                                    <a class="btn btn-outline-primary" href="javascript:;"
                                       onclick="document.getElementById('launch-form').submit();">Launch</a>
                                    <a class="btn btn-outline-primary"
                                       href="{{ route('dashboard.elections.edit', $election->getKey()) }}">Edit</a>
                                    <a class="btn btn-outline-danger" href="javascript:;"
                                       onclick="document.getElementById('delete-form').submit();">Delete</a>
                                </div>

                                <form action="{{ route('dashboard.elections.launch', $election->getKey()) }}"
                                      method="post"
                                      id="launch-form">
                                    @csrf
                                </form>
                                <form action="{{ route('dashboard.elections.destroy', $election->getKey()) }}"
                                      method="post"
                                      id="delete-form">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @elseif($election['status'] == 1)
                                <div class="btn-group" role="group">
                                    <a href="javascript:;" onclick="document.getElementById('complete-form').submit();"
                                       class="btn btn-outline-danger">Stop and Complete</a>
                                    <a class="btn btn-outline-primary"
                                       href="#">Show Voters</a>
                                </div>

                                <form action="{{ route('dashboard.elections.complete', $election->getKey()) }}"
                                      method="post"
                                      id="complete-form">
                                    @csrf
                                </form>
                            @elseif($election['status'] == 2)
                                <div class="btn-group" role="group">
                                    <a class="btn btn-outline-primary"
                                       href="{{ route('election.show.result', $election->getKey()) }}">Show result</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection