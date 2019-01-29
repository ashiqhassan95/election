@extends('dashboard.layouts.master', ['selected_nav' => 'positions'])
@section('title')
    Edit position
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Positions</span>
            <h3 class="page-title">Edit Position</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.positions.update', $position->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   id="titleInput" name="title" value="{{ $position->title }}">
                            @foreach($errors->get('title') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Position Form -->
        </div>
    </div>
@endsection