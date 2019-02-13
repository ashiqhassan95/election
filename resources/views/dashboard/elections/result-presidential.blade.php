@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Election result
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Union Election 2019 Result</h3>
        </div>
    </div>

    @foreach($data as $position)
        <div class="row">
            <div class="col-12">
                <div class="card card-small mb-3">
                    <div class="card-header bg-secondary text-white">
                        Result for {{ $position->title }} position
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>Candidate Name</th>
                                <th>Votes</th>
                                <th>Percentage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($position->candidates as $candidate)
                                <tr>
                                    <td>{{ $candidate['name'] }}</td>
                                    <td>{{ $candidate['votes'] }}</td>
                                    <td>{{ $candidate['percentage'] }}%</td>
                                </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td>Total votes</td>
                                <td>{{ $position['total_votes'] }}</td>
                                <td>100%</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection