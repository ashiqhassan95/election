@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Create election
@endsection

@push('page-content-title')
    Elections
@endpush

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Add New Election</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.elections.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text"
                                   name="title" id="titleInput" value="{{ old('title') }}">
                            @foreach($errors->get('title') as $error)
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $error }}</strong>
                                        </span>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="type">Please select election type</label>
                            <select name="type" class="form-control" id="type">
                                <option value="0">Presidential</option>
                                <option value="1">Parliamentary</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection