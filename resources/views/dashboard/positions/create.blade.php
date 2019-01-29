@extends('dashboard.layouts.master', ['selected_nav' => 'positions'])
@section('title')
    Create position
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Positions</span>
            <h3 class="page-title">Add New Position</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Position Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.positions.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   id="titleInput" name="title" value="{{ old('title') }}">
                            @foreach($errors->get('title') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Position Form -->
        </div>
    </div>
@endsection