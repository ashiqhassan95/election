@extends('dashboard.layouts.master', ['selected_nav' => 'positions'])
@section('title')
    Positions
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        @include('dashboard.includes.data-table-top-options', [
            'title' => 'Positions',
            'create_link' => route('dashboard.positions.create'),
            'export_link_csv' => route('dashboard.positions.create', 'csv'),
            'export_link_excel' => route('dashboard.positions.export', 'excel'),
        ])
    </div>
    <!-- End Page Header -->

    <!-- Transaction History Table -->
    <table class="transaction-history d-none">
        <thead>
        <tr>
            <th>Title</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($positions as $position)
            <tr>
                <td>
                    <a href="{{ route('dashboard.positions.show', $position->id) }}">{{ $position->title }}</a>
                </td>
                <td>{{ date('d-m-Y', strtotime($position->created_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($position->updated_at)) }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.positions.edit', $position->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>


                        <form class="d-inline" action="{{ route('dashboard.positions.destroy', $position->id) }}"
                              method="post">
                            @csrf
                            @method('delete')
                            {{--<button type="button" class="btn btn-white">--}}
                                {{--<i class="material-icons">&#xE872;</i>--}}
                            {{--</button>--}}
                            @include('dashboard.children.delete-item')
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
    {{--Positions--}}
{{--@endsection--}}

{{--@section('content')--}}
    {{--<div class="row mt-4">--}}
        {{--<div class="col">--}}
            {{--<div class="d-flex mb-3 align-items-center">--}}
                {{--<div class="flex-grow-1">--}}
                    {{--<h4 class="m-0">Positions</h4>--}}
                {{--</div>--}}
                {{--<div class="d-inline">--}}
                    {{--<a href="{{ route('dashboard.positions.create') }}" class="btn btn-primary">Create</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<table class="table table-bordered table-hover bg-white">--}}
                {{--<thead class="thead-light">--}}
                {{--<tr>--}}
                    {{--<th scope="col">Title</th>--}}
                    {{--<th scope="col">Created at</th>--}}
                    {{--<th scope="col">Updated at</th>--}}
                    {{--<th scope="col">Actions</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@forelse($positions as $position)--}}
                    {{--<tr>--}}
                        {{--<td><a href="{{ route('dashboard.positions.show', $position->id) }}">{{ $position->title }}</a></td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($position->created_at)) }}</td>--}}
                        {{--<td>{{ date('d-m-Y', strtotime($position->updated_at)) }}</td>--}}
                        {{--<td>--}}
                            {{--<div class="d-inline">--}}
                                {{--<a class="btn btn-sm btn-secondary" href="{{ route('dashboard.positions.edit', $position->id) }}">Edit</a>--}}
                                {{--<form class="d-inline" action="{{ route('dashboard.positions.destroy', $position->id) }}"--}}
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
            {{--{{ $positions->links() }}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}