@extends('dashboard.layouts.master', ['selected_nav' => 'standards'])
@section('title')
    Create standards
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Standards</span>
            <h3 class="page-title">Add New Standard</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.standards.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nameInput">Name</label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   id="nameInput" name="name" value="{{ old('title') }}">
                            @foreach($errors->get('name') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection