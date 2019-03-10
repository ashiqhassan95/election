@extends('dashboard.layouts.master', ['selected_nav' => 'standards'])
@section('title')
    Standards
@endsection

@push('page-content-title')
    Standards
@endpush

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="page-title" style="line-height: 35px; font-weight: bold; font-size: 20px">Standards List</span>
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div>
                <a class="btn btn-primary" href="{{ route('dashboard.standards.create') }}">Create</a>
            </div>
        </div>
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
                        <a class="btn btn-white" data-toggle="tooltip" title="Edit"
                           href="{{ route('dashboard.standards.edit', $standard->id) }}">
                            <i class="material-icons">edit</i>
                        </a>
                        <button type="button" class="btn btn-white" data-toggle="modal"
                                data-target="#deleteModal-{{ $standard->getKey() }}">
                            <i class="material-icons">delete</i>
                        </button>
                        @include('dashboard.children.delete-item', [
                            'link' => route('dashboard.standards.destroy', $standard->getKey()),
                            'id' => $standard->getKey()
                            ])
                    </div>
                    <form id="delete-form" action="{{ route('dashboard.standards.destroy', $standard->id) }}"
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