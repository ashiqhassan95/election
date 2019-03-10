@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Elections
@endsection

@push('page-content-title')
    Elections
@endpush

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="page-title" style="line-height: 35px; font-weight: bold; font-size: 20px">Elections List</span>
        </div>

        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div>
                <a class="btn btn-primary" href="{{ route('dashboard.elections.create') }}">Create</a>
            </div>
        </div>
    </div>

    <table class="data-table elections-table d-none">
        <thead>
        <tr>
            <th>Title</th>
            <th>Poll start at</th>
            <th>Poll end at</th>
            <th>Type</th>
            <th>Status</th>
            <th>Created on</th>
            <th>Updated on</th>
        </tr>
        </thead>
        <tbody>
        @forelse($elections as $election)
            <tr>
                <td><a href="{{ route('dashboard.elections.show', $election->id) }}">{{ $election->title }}</a></td>
                <td>{{ $election->poll_start_at ?? 'NIL' }}</td>
                <td>{{ $election->poll_end_at ?? 'NIL' }}</td>
                <td>{{ $election->getType() }}</td>
                <td>
                    @if($election['status'] == 0)
                        <span class="text-accent">{{ $election->getStatus() }}</span>
                    @elseif($election['status'] == 1)
                        <span class="text-success">{{ $election->getStatus() }}</span>
                    @elseif($election['status'] == 2)
                        <span class="text-danger">{{ $election->getStatus() }}</span>
                    @endif
                </td>
                <td>{{ date('d-m-Y', strtotime($election->created_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($election->updated_at)) }}</td>
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
        $('.data-table').DataTable({
            responsive: !0,
            ordering: true,
            order: [[ 6, "desc" ]], // Order by created at columnd
        });
    </script>
@endpush