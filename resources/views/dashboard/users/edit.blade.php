@extends('dashboard.layouts.master', ['selected_nav' => 'users'])
@section('title')
    Edit user
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Users</span>
            <h3 class="page-title">Edit User</h3>
        </div>
    </div>

    <!-- End Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md">
            <!-- Add New Standard Form -->
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.users.update', $user->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="roleSelect">Change user role</label>
                            <select name="role" id="roleSelect"
                                    class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Super admin</option>
                                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Viewer</option>
                            </select>
                            @foreach($errors->get('role') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-toggle custom-toggle-sm mb-1">
                                <input type="checkbox" class="custom-control-input" name="is_active"
                                       id="activeCheckBox" {{ $user->is_active == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="activeCheckBox">Is active</label>
                            </div>
                            @foreach($errors->get('is_active') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>
                        <button class="btn btn-primary"><i class="material-icons mr-1">save</i>Update</button>
                    </form>
                </div>
            </div>
            <!-- / Add New Standard Form -->
        </div>
    </div>
@endsection