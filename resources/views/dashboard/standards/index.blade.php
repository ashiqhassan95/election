@extends('dashboard.layouts.master', ['selected_nav' => 'standards'])
@section('title')
    Standards
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')

    <div class="page-header row no-gutters py-4">
        @include('dashboard.includes.data-table-top-options', [
            'title' => 'Standards',
            'create_link' => route('dashboard.standards.create'),
            'export_link_csv' => route('dashboard.standards.create', 'csv'),
            'export_link_excel' => route('dashboard.standards.export', 'excel'),
            //'import_link' => route('dashboard.standards.import'),
        ])
    </div>

    <table class="data-table standards-table d-none">
        <thead>
        <tr>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($standards as $standard)
            <tr>
                <td>
                    <a href="{{ route('dashboard.standards.show', $standard->id) }}">{{ $standard->name }}</a>
                </td>
                <td>{{ date('d-m-Y', strtotime($standard->created_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($standard->updated_at)) }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.standards.edit', $standard->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>
                        <form class="d-inline" action="{{ route('dashboard.standards.destroy', $standard->id) }}"
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

@endsection
@push('js-body')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script>
        $('.data-table').DataTable({responsive: !0});
    </script>
@endpush

{{--@extends('dashboard.layouts.master')--}}
{{--@section('title')--}}
{{--Standards--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--<div class="row mt-4">--}}
{{--<div class="col">--}}
{{--<div class="d-flex mb-3 align-items-center">--}}
{{--<div class="flex-grow-1">--}}
{{--<h4 class="m-0">Standards</h4>--}}
{{--</div>--}}
{{--<div class="d-inline">--}}
{{--<a href="{{ route('dashboard.standards.create') }}" class="btn btn-primary">Create</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<table class="table table-bordered table-hover bg-white">--}}
{{--<thead class="thead-light">--}}
{{--<tr>--}}
{{--<th scope="col">Name</th>--}}
{{--<th scope="col">Created at</th>--}}
{{--<th scope="col">Updated at</th>--}}
{{--<th scope="col">Actions</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--@forelse($standards as $standard)--}}
{{--<tr>--}}
{{--<td><a href="{{ route('dashboard.standards.show', $standard->id) }}">{{ $standard->name }}</a></td>--}}
{{--<td>{{ date('d-m-Y', strtotime($standard->created_at)) }}</td>--}}
{{--<td>{{ date('d-m-Y', strtotime($standard->updated_at)) }}</td>--}}
{{--<td>--}}
{{--<div class="d-inline">--}}
{{--<a class="btn btn-sm btn-secondary" href="{{ route('dashboard.standards.edit', $standard->id) }}">Edit</a>--}}
{{--<form class="d-inline" action="{{ route('dashboard.standards.destroy', $standard->id) }}" method="post">--}}
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
{{--{{ $standards->links() }}--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}