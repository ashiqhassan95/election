@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Launch election
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Election Launched</h3>
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
                            <td><strong>Election URL</strong></td>
                            <td>{{ $election->url }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection