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
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><strong>Title</strong></td>
                            <td>{{ $election->title }}</td>
                        </tr>
                        <tr>
                            <td><strong>Polling start at</strong></td>
                            <td>{{ $election->poll_start_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>Polling end at</strong></td>
                            <td>{{ $election->poll_end_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>Type of election</strong></td>
                            <td>{{ $election->getType() }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>{{ $election->getStatus() }}</td>
                        </tr>
                        @if($election['status'] == 1)
                            <tr>
                                <td><strong>Url</strong></td>
                                <td>
                                    <a href="{{ route('election.vote', $election['slug']) }}" target="_blank">{{ route('election.vote', $election['slug']) }}</a>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="btn-group" role="group">
                        @if($election['status'] == 0)
                            <form action="{{ route('dashboard.elections.launch', $election->getKey()) }}" method="post"
                                  class="btn-group">
                                @csrf
                                <button class="btn btn-primary">Launch</button>
                            </form>
                        @elseif($election['status'] == 1)
                            <form action="{{ route('dashboard.elections.complete', $election->getKey()) }}"
                                  method="post"
                                  class="btn-group">
                                @csrf
                                <button class="btn btn-primary">Complete</button>
                            </form>
                        @elseif($election['status'] == 2)
                            <form action="{{ route('dashboard.elections.destroy', $election->getKey()) }}" method="post"
                                  class="btn-group">
                                @csrf
                                <button class="btn btn-primary">Delete</button>
                            </form>
                        @endif
                        <a class="btn btn-primary" href="{{ route('dashboard.elections.edit', $election->getKey()) }}">Edit</a>
                        <form class="btn-group" action="{{ route('dashboard.elections.destroy', $election->getKey()) }}"
                              method="post">
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                            <input type="hidden" class="btn">
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection