@extends('dashboard.layouts.master', ['selected_nav' => 'dashboard'])
@section('title')
    Dashboard
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"/>
@endpush

@section('content')
    <div class="row page-header no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Overview</h3>
        </div>
    </div>

    <!-- Small Stats Blocks -->
    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase text-white">Standards</span>
                            <h6 class="stats-small__value count my-3 text-white">{{ $standards_count }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase text-white">Voters</span>
                            <h6 class="stats-small__value count my-3 text-white">{{ $voters_count }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase text-white">Positions</span>
                            <h6 class="stats-small__value count my-3 text-white">{{ $positions_count }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase text-white">Elections</span>
                            <h6 class="stats-small__value count my-3 text-white">{{ $elections_count }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase text-white">Active Candidates</span>
                            <h6 class="stats-small__value count my-3 text-white">{{ $candidates_count }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Small Stats Blocks -->
@endsection

@push('js-body')

@endpush

