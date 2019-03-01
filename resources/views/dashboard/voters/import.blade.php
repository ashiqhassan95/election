@extends('dashboard.layouts.master', ['selected_nav' => 'voters'])
@section('title')
    Import voters
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Voters</span>
            <h3 class="page-title">Import Bulk Voters</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.voters.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="fileInput">Select CSV file</label>
                            <div class="custom-file">
                                <input type="file" id="fileInput" name="file"
                                       class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }} custom-file-input">
                                <label class="custom-file-label overflow-hidden" for="fileInput">Choose
                                    file...</label>
                                @foreach($errors->get('file') as $error)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <button class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection