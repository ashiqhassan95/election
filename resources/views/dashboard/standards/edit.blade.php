@extends('dashboard.layouts.master', ['selected_nav' => 'standards'])
@section('title')
    Edit standard
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Standards</span>
            <h3 class="page-title">Edit Standard</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Standard Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.standards.update', $standard->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nameInput">Name</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   id="nameInput" name="name" value="{{ $standard->name }}">
                            @foreach($errors->get('name') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Standard Form -->
        </div>
    </div>
@endsection