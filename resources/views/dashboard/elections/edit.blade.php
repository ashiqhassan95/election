@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Edit election
@endsection

@section('message')
    @includeWhen(session()->has('message'), 'dashboard.includes.session-alert-message')
@endsection

@push('css-head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col mb-0">
            <span class="text-uppercase page-subtitle">Elections</span>
            <h3 class="page-title">Edit Election</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md">
            <div class="card card-small mb-3">
                <div class="card-body">
                    <form action="{{ route('dashboard.elections.update', $election->getKey()) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="titleInput">Title</label>
                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text"
                                   name="title" id="titleInput" value="{{ $election->title }}">
                            @foreach($errors->get('title') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        </div>

                        {{--<div class="form-row">--}}
                            {{--<div class="col">--}}
                                {{--<div class="form-group">--}}
                                    {{--<p>{{ $election->poll_start_at->format('d-m-Y H:i:s') }}</p>--}}
                                    {{--<label for="pollStartDateTime">Poll start date time</label>--}}
                                    {{--<input class="form-control flatpickr-input{{ $errors->has('poll_start_at') ? ' is-invalid' : '' }}"--}}
                                           {{--type="datetime-local" name="poll_start_at"--}}
                                           {{--id="pollStartDateTime" data-input="true" placeholder="select date and time"--}}
                                           {{--value="{{ $election->poll_start_at->format('d-m-Y H:i:s') }}">--}}
                                    {{--@foreach($errors->get('poll_start_at') as $error)--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $error }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col">--}}
                                {{--<div class="form-group">--}}
                                    {{--<p>{{ $election->poll_end_at->format('d-m-Y H:i:s') }}</p>--}}
                                    {{--<label for="pollEndDateTime">Poll end date time</label>--}}
                                    {{--<input class="form-control flatpickr-input{{ $errors->has('poll_end_at') ? ' is-invalid' : '' }}"--}}
                                           {{--type="datetime-local" name="poll_end_at"--}}
                                           {{--id="pollEndDateTime" data-input placeholder="select date and time"--}}
                                           {{--value="{{ $election->poll_end_at->format('d-m-Y H:i:s') }}">--}}
                                    {{--@foreach($errors->get('poll_end_at') as $error)--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $error }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="type">Please select election type</label>
                            <select name="type" class="form-control" id="type">
                                <option value="0" {{ $election->type == 0 ? 'selected':'' }}>Presidential</option>
                                <option value="1" {{ $election->type == 1 ? 'selected':'' }}>Parliamentary</option>
                            </select>
                        </div>
                        <button class="btn btn-primary"><i class="material-icons mr-1">save</i>Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-body')
    {{--<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>--}}
    {{--<script>--}}
    {{--$(".flatpickr-input").flatpickr({--}}
    {{--enableTime: true,--}}
    {{--allowInput: true,--}}
    {{--dateFormat: "Y-m-d H:i",--}}
    {{--});--}}
    {{--</script>--}}
@endpush