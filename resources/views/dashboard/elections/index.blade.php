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
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        @if($election['status'] == 0)
                            <a class="btn btn-success mr-1"
                               href="{{ route('dashboard.elections.launch', $election->getKey()) }}"><i
                                        class="material-icons">
                                    power_settings_new
                                </i></a>
                        @elseif($election['status'] == 1)
                            <form action="{{ route('dashboard.elections.complete', $election->getKey()) }}"
                                  method="post">
                                @csrf
                                <button class="btn btn-danger mr-1">
                                    <i class="material-icons">
                                        power_settings_new
                                    </i>
                                </button>
                            </form>
                        @elseif($election['status'] == 2)
                            <form action="{{ route('dashboard.elections.complete', $election->getKey()) }}"
                                  method="post">
                                @csrf
                                <button class="btn btn-primary mr-1">
                                    Result
                                </button>
                            </form>
                        @endif
                        <a class="btn btn-white mr-1" href="{{ route('dashboard.elections.edit', $election->id) }}">
                            <i class="material-icons">&#xE254;</i>
                        </a>
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
    <script>
        $('.data-table').DataTable({responsive: !0});
    </script>
@endpush