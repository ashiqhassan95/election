@extends('dashboard.layouts.master', ['selected_nav' => 'voters'])
@section('title')
    Voters
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        @include('dashboard.includes.data-table-top-options', [
            'title' => 'Voters',
            'create_link' => route('dashboard.voters.create'),
            'export_link_csv' => route('dashboard.voters.create', 'csv'),
            'export_link_excel' => route('dashboard.voters.export', 'excel'),
        ])
    </div>
    <!-- End Page Header -->

    <!-- Transaction History Table -->
    <table class="transaction-history d-none">
        <thead>
        <tr>
            <th>Name</th>
            <th>Admission #</th>
            <th>Roll #</th>
            <th>UID</th>
            <th>Standard</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>Created on</th>
            {{--<th>Updated on</th>--}}
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($voters as $voter)
            <tr>
                <td>
                    <a href="{{ route('dashboard.voters.show', $voter->id) }}">{{ $voter->name }}</a>
                </td>
                <td>{{ $voter->admission_number }}</td>
                <td>{{ $voter->roll_number }}</td>
                <td>{{ $voter->uid }}</td>
                <td>{{ $voter->standard->name }}</td>
                <td>{{ $voter->gender() }}</td>
                <td>{{ date('d-m-Y', strtotime($voter->birth_date))  }}</td>
                <td>{{ date('d-m-Y', strtotime($voter->created_at)) }}</td>
                {{--<td>{{ date('d-m-Y', strtotime($voter->updated_at)) }}</td>--}}
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.voters.edit', $voter->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>
                        <form class="d-inline" action="{{ route('dashboard.voters.destroy', $voter->id) }}"
                              method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-white">
                                <i class="material-icons">&#xE872;</i>
                            </button>
                        </form>
                    </div>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center text-danger"><b>no data available</b></td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <!-- End Transaction History Table -->
@endsection


@push('js-body')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('js/shards-pro/app/app-transaction-history.1.2.0.min.js') }}"></script>
@endpush

{{--@extends('dashboard.layouts.master')--}}
{{--@section('title')--}}
    {{--Voters--}}
{{--@endsection--}}
{{--@section('content')--}}
    {{--<div class="row mt-4">--}}
        {{--<div class="col">--}}
            {{--<div class="d-flex mb-3 align-items-center">--}}
                {{--<div class="flex-grow-1">--}}
                    {{--<h4 class="m-0">Voters</h4>--}}
                {{--</div>--}}
                {{--<div class="d-inline">--}}
                    {{--<a href="{{ route('dashboard.voters.create') }}" class="btn btn-primary">Create</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<table class="table table-bordered table-hover bg-white">--}}
                {{--<thead class="thead-light">--}}
                {{--<tr>--}}
                    {{--<th scope="col">Name</th>--}}
                    {{--<th scope="col">Admission #</th>--}}
                    {{--<th scope="col">Roll #</th>--}}
                    {{--<th scope="col">UID</th>--}}
                    {{--<th scope="col">Standard</th>--}}
                    {{--<th scope="col">Gender</th>--}}
                    {{--<th scope="col">Date of birth</th>--}}
                    {{--<th scope="col">Created on</th>--}}
                    {{--<th scope="col">Updated on</th>--}}
                    {{--<th scope="col">Actions</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@forelse($voters as $voter)--}}
                    {{--<tr>--}}
                        {{--<td><a href="{{ route('dashboard.voters.show', $voter->id) }}">{{ $voter->name }}</a></td>--}}
                        {{--<td>{{ $voter->admission_number }}</td>--}}
                        {{--<td>{{ $voter->roll_number }}</td>--}}
                        {{--<td>{{ $voter->uid }}</td>--}}
                        {{--<td>{{ $voter->standard->name }}</td>--}}
                        {{--<td>{{ $voter->gender() }}</td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($voter->birth_date))  }}</td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($voter->created_at)) }}</td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($voter->updated_at)) }}</td>--}}
                        {{--<td>--}}
                            {{--<div class="d-inline">--}}
                                {{--<a class="btn btn-sm btn-secondary"--}}
                                   {{--href="{{ route('dashboard.voters.edit', $voter->id) }}">Edit</a>--}}
                                {{--<form class="d-inline" action="{{ route('dashboard.voters.destroy', $voter->id) }}" method="post">--}}
                                    {{--@csrf--}}
                                    {{--@method('delete')--}}
                                    {{--<button class="btn btn-sm btn-secondary">Delete</button>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@empty--}}
                    {{--<tr>--}}
                        {{--<td colspan="10" class="text-center text-danger"><b>no data available</b></td>--}}
                    {{--</tr>--}}
                {{--@endforelse--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col">--}}
            {{--{{ $voters->links() }}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}