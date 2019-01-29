@extends('dashboard.layouts.master', ['selected_nav' => 'users'])
@section('title')
    Users
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        {{--<div class="col-12 col-md-4 text-center text-sm-left mb-4 mb-sm-0">--}}
        <div class="col-12 col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span class="text-uppercase page-subtitle">Users</span>
            <h3 class="page-title">All Users</h3>
        </div>
        {{--<div class="col-12 col-md-6 offset-md-2 d-flex align-items-center justify-content-center justify-content-sm-end">--}}
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
            <div>
                <a class="btn btn-primary" href="{{ route('invite.show') }}"><i
                            class="material-icons">add</i> Invite user</a>
                <a class="btn btn-light" href="#">Export</a>
                <a class="btn btn-light" href="#">Import</a>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Transaction History Table -->
    <table class="transaction-history d-none">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Is Active</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>
                    <a href="{{ route('dashboard.users.show', $user->id) }}">{{ $user->name }}</a>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRole() }}</td>
                <td>{{ $user->getIsActive() }}</td>
                <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <a class="btn btn-white"
                           href="{{ route('dashboard.users.edit', $user->id) }}"><i
                                    class="material-icons">&#xE254;</i></a>
                        <form class="d-inline" action="{{ route('dashboard.users.destroy', $user->id) }}"
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