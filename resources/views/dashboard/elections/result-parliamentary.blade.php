@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Election result
@endsection

@push('page-content-title')
    Elections Result
@endpush

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="page-title"
                  style="line-height: 35px; font-weight: bold; font-size: 20px">{{ $election->title }}</span>
        </div>

        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div class="form-inline">
                <label class="mr-2 font-weight-bold" for="standardSelect">Select standard</label>
                <select class="custom-select" name="standard" id="standardSelect" onchange="location = this.value;">
                    @foreach($standards as $standard)
                        <option value="?standard={{ $standard->getKey() }}"
                                {{ $selected_standard == $standard->getKey() ? 'selected': '' }}>
                            {{ $standard['name'] }}</option>
                    @endforeach
                </select>
            </div>
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