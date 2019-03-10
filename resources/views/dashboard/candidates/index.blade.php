@extends('dashboard.layouts.master', ['selected_nav' => 'candidates'])
@section('title')
    Candidates
@endsection

@push('page-content-title')
    Candidates
@endpush

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="page-title" style="line-height: 35px; font-weight: bold; font-size: 20px">Candidates List</span>
        </div>

        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div>
                <a class="btn btn-primary" href="{{ route('dashboard.candidates.create') }}">Create</a>
            </div>
        </div>
    </div>

    <table class="data-table candidates-table d-none">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Admission #</th>
            <th>Roll #</th>
            <th>Election</th>
            <th>Position</th>
            <th>Standard</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($candidates as $candidate)
            <tr>
                <td>
                    <div>
                        <img class="card-post__author-avatar" style="display: unset" src="{{ $candidate->image }}"
                             alt="">
                    </div>
                </td>
                <td>
                    <a href="{{ route('dashboard.candidates.show', $candidate->id) }}">{{ $candidate->voter->name }}</a>
                </td>
                <td>{{ $candidate->voter->admission_number }}</td>
                <td>{{ $candidate->voter->roll_number }}</td>
                <td>
                    <a href="{{ route('dashboard.elections.show', $candidate->election->getKey()) }}">
                        {{ $candidate->election->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('dashboard.positions.show', $candidate->position->getKey()) }}">
                        {{ $candidate->position->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('dashboard.standards.show', $candidate->standard->getKey()) }}">
                        {{ $candidate->standard->name }}
                    </a>
                </td>
                <td>{{ $candidate->voter->gender() }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white" data-toggle="tooltip" title="Edit"
                           href="{{ route('dashboard.candidates.edit', $candidate->id) }}">
                            <i class="material-icons">edit</i>
                        </a>

                        <a class="btn btn-white" data-toggle="tooltip" title="Delete"
                           href="javascript:;" onclick="document.getElementById('delete-form').submit()">
                            <i class="material-icons">delete</i>
                        </a>
                    </div>
                    <form id="delete-form" class="d-inline"
                          action="{{ route('dashboard.candidates.destroy', $candidate->id) }}"
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