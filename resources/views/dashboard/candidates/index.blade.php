@extends('dashboard.layouts.master', ['selected_nav' => 'candidates'])
@section('title')
    Candidates
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        @include('dashboard.includes.data-table-top-options', [
            'title' => 'Candidates',
            'create_link' => route('dashboard.candidates.create'),
            'export_link_csv' => route('dashboard.candidates.export', 'csv'),
            'export_link_excel' => route('dashboard.candidates.export', 'excel'),
        ])
    </div>
    <!-- End Page Header -->

    <!-- Transaction History Table -->
    <table class="data-table candidates-table d-none">
        <thead>
        <tr>
            <th>Name</th>
            <th>Admission #</th>
            <th>Roll #</th>
            <th>Position</th>
            <th>Standard</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Created on</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($candidates as $candidate)
            <tr>
                <td>
                    <a href="{{ route('dashboard.candidates.show', $candidate->id) }}">{{ $candidate->voter->name }}</a>
                </td>
                <td>{{ $candidate->voter->admission_number }}</td>
                <td>{{ $candidate->voter->roll_number }}</td>
                <td>{{ $candidate->position->title }}</td>
                <td>{{ $candidate->standard->name }}</td>
                <td>{{ $candidate->voter->gender() }}</td>
                <td>{{ $candidate->voter->birth_date }}</td>
                {{--<td>{{ date('d-m-Y', strtotime($candidate->birth_date))  }}</td>--}}
                <td>{{ date('d-m-Y', strtotime($candidate->created_at)) }}</td>
                {{--<td>{{ date('d-m-Y', strtotime($candidate->updated_at)) }}</td>--}}
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.candidates.edit', $candidate->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>
                        <form class="d-inline" action="{{ route('dashboard.candidates.destroy', $candidate->id) }}"
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