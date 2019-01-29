@extends('dashboard.layouts.master', ['selected_nav' => 'users'])
@section('title')
    Invite user
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Users</span>
            <h3 class="page-title">Invite User</h3>
        </div>
    </div>
    <!-- End Page Header -->

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('invite.process') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="emailInput">Enter email</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" id="emailInput">
                            @foreach($errors->get('email') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="roleSelect">Choose a role</label>
                            <select name="role" id="roleSelect"
                                    class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>Super admin</option>
                                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Viewer</option>
                            </select>
                            @foreach($errors->get('role') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Send invite</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection