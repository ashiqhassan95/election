@extends('dashboard.layouts.master', ['selected_nav' => 'settings.general'])
@section('title')
    General Settings
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mt-4">
            <!-- Edit User Details Card -->
            <div class="card card-small edit-user-details mb-4">
                <div class="card-header p-0">
                    <div class="border-bottom clearfix d-flex">
                        @include('dashboard.partials.dashboard-settings-nav-tab', ['selected_nav'=> 'settings.general'])
                    </div>
                </div>
                <div class="card-body p-0">
                    <form action="#" class="py-4">
                        <div class="form-row mx-4">
                            <div class="col mb-3">
                                <h6 class="form-text m-0">General</h6>
                                <p class="form-text text-muted m-0">Setup your general profile details.</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer border-top">
                    <a href="#" class="btn btn-sm btn-accent ml-auto d-table mr-3">Save Changes</a>
                </div>
            </div>
            <!-- End Edit User Details Card -->
        </div>
    </div>
@endsection