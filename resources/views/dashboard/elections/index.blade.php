@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Elections
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        @include('dashboard.includes.data-table-top-options', [
            'title' => 'Elections',
            'create_link' => route('dashboard.elections.create'),
        ])
    </div>
    <!-- End Page Header -->

    <!-- Transaction History Table -->
    <table class="transaction-history d-none">
        <thead>
        <tr>
            <th>Title</th>
            <th>Poll start at</th>
            <th>Poll end at</th>
            <th>Type</th>
            <th>Created on</th>
            <th>Updated on</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($elections as $election)
            <tr>
                <td><a href="{{ route('dashboard.elections.show', $election->id) }}">{{ $election->title }}</a></td>
                <td>{{ $election->poll_start_at }}</td>
                <td>{{ $election->poll_end_at }}</td>
                <td>{{ $election->getType() }}</td>
                <td>{{ date('d-m-Y', strtotime($election->created_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($election->updated_at)) }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.elections.edit', $election->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>
                        <form class="d-inline" action="{{ route('dashboard.elections.destroy', $election->id) }}"
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