@extends('dashboard.layouts.master', ['selected_nav' => 'elections'])
@section('title')
    Show Election
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col">
            <table width="300">
                <tr>
                    <td>Title</td>
                    <td>{{ $election->title }}</td>
                </tr>
                <tr>
                    <td>Academic year</td>
                    <td>
                        {{ date('Y', strtotime($election->academic_start_year)) }} -
                        {{ date('Y', strtotime($election->academic_end_year)) }}
                    </td>
                </tr>
                <tr>
                    <td>Poll start date time</td>
                    <td>{{ date('d-m-Y', strtotime($election->poll_start_date_time)) }}</td>
                </tr>
                <tr>
                    <td>Poll end date time</td>
                    <td>{{ date('d-m-Y', strtotime($election->poll_end_date_time)) }}</td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{ date('d-m-Y', strtotime($election->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{ date('d-m-Y', strtotime($election->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Created by</td>
                    <td>{{ $election->user->name ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection