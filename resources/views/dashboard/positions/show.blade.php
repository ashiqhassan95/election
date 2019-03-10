@extends('dashboard.layouts.master', ['selected_nav' => 'positions'])
@section('title')
    Show position
@endsection

@push('page-content-title')
    Positions
@endpush

@section('content')
    <div class="row page-header row no-gutters py-4">
        <div class="col mb-0">
            <h3 class="page-title">Position details</h3>
        </div>
    </div>

    @push('css-head')
        <style>
            .entity-details .col span {
                display: block;
            }

            .entity-details .col span:last-child {
                font-weight: bold;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body border-bottom">
                    <div class="entity-details">
                        <div class="row mb-3">
                            <div class="col">
                                <span>Title</span>
                                <span>{{ $position->title }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col w-50">
                                <span>Created at</span>
                                <span>{{ $position->created_at }}</span>
                            </div>
                            <div class="col w-50">
                                <span>Updated at</span>
                                <span>{{ $position->updated_at }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col">
                            <form id="delete-form"
                                  action="{{ route('dashboard.positions.destroy', $position->getKey()) }}"
                                  method="post">
                                @csrf
                                @method('delete')
                            </form>

                            <div class="btn-group">
                                <a class="btn btn-outline-primary"
                                   href="{{ route('dashboard.positions.edit', $position->getKey()) }}">Edit</a>

                                <a class="btn btn-outline-danger"
                                   onclick="document.getElementById('delete-form').submit()"
                                   href="javascript:;">Delete</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection