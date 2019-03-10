@extends('dashboard.layouts.master', ['selected_nav' => 'positions'])
@section('title')
    Positions
@endsection

@push('page-content-title')
    Positions
@endpush

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="page-title" style="line-height: 35px; font-weight: bold; font-size: 20px">Positions List</span>
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div>
                <a class="btn btn-primary" href="{{ route('dashboard.positions.create') }}">Create</a>
            </div>
        </div>
    </div>

    <table class="data-table positions-table d-none">
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
                        <a class="btn btn-white" data-toggle="tooltip" title="Edit"
                           href="{{ route('dashboard.positions.edit', $position->id) }}">
                            <i class="material-icons">edit</i>
                        </a>

                        <a class="btn btn-white" data-toggle="tooltip" title="Delete"
                           href="javascript:;" onclick="document.getElementById('delete-form').submit()">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                    <form id="delete-form" class="d-inline"
                          action="{{ route('dashboard.positions.destroy', $position->id) }}"
                          method="post">
                        @csrf
                        @method('delete')
                    </form>
                </td>
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
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'bottom'
            });
        });
    </script>
@endpush