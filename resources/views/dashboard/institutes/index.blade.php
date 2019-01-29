@extends('dashboard.layouts.master', ['selected_nav' => 'institutes'])
@section('title')
    Institutes
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
            <span class="text-uppercase page-subtitle">Institutes</span>
            <h3 class="page-title">All Institutes</h3>
        </div>
        <div class="offset-sm-4 col-4 d-flex col-12 col-sm-4 d-flex align-items-center">
            <div id="transaction-history-date-range" class="input-daterange input-group input-group-sm ml-auto">
                <input type="text" class="input-sm form-control" name="start" placeholder="Start Date"
                       id="analytics-overview-date-range-1">
                <input type="text" class="input-sm form-control" name="end" placeholder="End Date"
                       id="analytics-overview-date-range-2">
                <span class="input-group-append">
                    <span class="input-group-text">
                      <i class="material-icons">&#xE916;</i>
                    </span>
                  </span>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Transaction History Table -->
    <table class="transaction-history d-none">
        <thead>
        <tr>
            <th>Name</th>
            {{--<th>Address</th>--}}
            {{--<th>City</th>--}}
            {{--<th>State</th>--}}
            <th>Country</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($institutes as $institute)
            <tr>
                <td>
                    <a href="{{ route('dashboard.institutes.show', $institute->id) }}">{{ $institute->name }}</a>
                </td>
                {{--<td>{{ $institute->address }}</td>--}}
                {{--<td>{{ $institute->city }}</td>--}}
                {{--<td>{{ $institute->state }}</td>--}}
                <td>{{ $institute->country }}</td>
                <td>{{ date('d-m-Y', strtotime($institute->created_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($institute->updated_at)) }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.institutes.edit', $institute->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>
                        <form class="d-inline" action="{{ route('dashboard.institutes.destroy', $institute->id) }}"
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
    {{--Institutes--}}
{{--@endsection--}}

{{--@section('content')--}}
    {{--<div class="row mt-4">--}}
        {{--<div class="col">--}}
            {{--<div class="d-flex mb-3 align-items-center">--}}
                {{--<div class="flex-grow-1">--}}
                    {{--<h4 class="m-0">Institutes</h4>--}}
                {{--</div>--}}
                {{--<div class="d-inline">--}}
                    {{--<a href="{{ route('dashboard.institutes.create') }}" class="btn btn-primary">Create</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<table class="table table-bordered table-hover bg-white">--}}
                {{--<thead class="thead-light">--}}
                {{--<tr>--}}
                    {{--<th scope="col">Name</th>--}}
                    {{--<th scope="col">Address</th>--}}
                    {{--<th scope="col">City</th>--}}
                    {{--<th scope="col">State</th>--}}
                    {{--<th scope="col">Country</th>--}}
                    {{--<th scope="col">Created at</th>--}}
                    {{--<th scope="col">Updated at</th>--}}
                    {{--<th scope="col">Actions</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@forelse($institutes as $institute)--}}
                    {{--<tr>--}}
                        {{--<td><a href="{{ route('dashboard.institutes.show', $institute->id) }}">{{ $institute->name }}</a></td>--}}
                        {{--<td>{{ $institute->address }}</td>--}}
                        {{--<td>{{ $institute->city }}</td>--}}
                        {{--<td>{{ $institute->state }}</td>--}}
                        {{--<td>{{ $institute->country }}</td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($institute->created_at)) }}</td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($institute->updated_at)) }}</td>--}}
                        {{--<td>--}}
                            {{--<div class="d-inline">--}}
                                {{--<a class="btn btn-sm btn-secondary" href="{{ route('dashboard.institutes.edit', $institute->id) }}">Edit</a>--}}
                                {{--<form class="d-inline" action="{{ route('dashboard.institutes.destroy', $institute->id) }}"--}}
                                      {{--method="post">--}}
                                    {{--@csrf--}}
                                    {{--@method('delete')--}}
                                    {{--<button class="btn btn-sm btn-secondary">Delete</button>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@empty--}}
                    {{--<tr>--}}
                        {{--<td colspan="4" class="text-center text-danger"><b>no data available</b></td>--}}
                    {{--</tr>--}}
                {{--@endforelse--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col">--}}
            {{--{{ $institutes->links() }}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}