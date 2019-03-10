@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Show election
@endsection

@push('page-content-title')
    Elections
@endpush

@section('content')
    <div class="row page-header row no-gutters py-4">
        <div class="col mb-0">
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

    <div class="row">
        <div class="col-lg-6 col-md">
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
                                <span>Type of election</span>
                                <span>{{ $election->getType() }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Election Status</span>
                                @if($election['status'] == 0)
                                    <span class="text-accent">{{ $election->getStatus() }}</span>
                                @elseif($election['status'] == 1)
                                    <span class="text-success">{{ $election->getStatus() }}</span>
                                @elseif($election['status'] == 2)
                                    <span class="text-danger">{{ $election->getStatus() }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Poll started at</span>
                                <span>{{ $election->poll_start_at ?? 'NIL' }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Poll ended at</span>
                                <span>{{ $election->poll_end_at ?? 'NIL' }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col w-50">
                                <span>Created at</span>
                                <span>{{ $election->created_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Updated at</span>
                                <span>{{ $election->updated_at }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <span>Number of candidates</span>
                                <span>{{ $election->candidates_count }}</span>
                            </div>
                        </div>

                        @if($election->status == '1')
                            <div class="row">
                                <div class="col">
                                    <span>Url</span>
                                    <span>
                                        <a href="{{ route('elections.vote', $election['slug']) }}"
                                              target="_blank">{{ route('elections.vote', $election['slug']) }}</a>
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

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
                                       href="{{ route('dashboard.elections.show.voters', $election->getKey()) }}">Show Voters</a>
                                </div>

                                <form action="{{ route('dashboard.elections.complete', $election->getKey()) }}"
                                      method="post"
                                      id="complete-form">
                                    @csrf
                                </form>
                            @elseif($election['status'] == 2)
                                <div class="btn-group" role="group">
                                    <a class="btn btn-outline-primary"
                                       href="{{ route('dashboard.elections.show.result', $election->getKey()) }}">Show result</a>
                                    <a class="btn btn-outline-primary"
                                       href="{{ route('dashboard.elections.show.voters', $election->getKey()) }}">Show Voters</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection