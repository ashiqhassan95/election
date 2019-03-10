@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Elections
@endsection

@push('page-content-title')
    Voters
@endpush

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="page-title" style="line-height: 35px; font-weight: bold; font-size: 20px">People who casted their vote</span>
        </div>

        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div>
                <button class="btn btn-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Export
                </button>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item"
                       href="{{ route('dashboard.elections.export.voters', $election->getKey()) }}?format=csv">CSV</a>
                    <a class="dropdown-item"
                       href="{{ route('dashboard.elections.export.voters', $election->getKey()) }}?format=excel">Excel</a>
                </div>
            </div>
        </div>
    </div>
    <table class="data-table voters-table d-none">
        <thead>
        <tr>
            <th>Name</th>
            <th>Admission #</th>
            <th>Roll #</th>
            <th>UID</th>
            <th>Standard</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>Voted at</th>
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
                <td>{{ date('Y-m-d', strtotime($voter->birth_date))  }}</td>
                <td class="text-danger">{{ date('g:i:s A, d-m-Y', strtotime($voter->voted_at)) }}</td>
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