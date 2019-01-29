@extends('dashboard.layouts.master', ['selected_nav' => 'voters'])
@section('title')
    Show voter
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col">
            <table width="300">
                <tr>
                    <td>Name</td>
                    <td>{{ $voter->name }}</td>
                </tr>
                <tr>
                    <td>Admission Number</td>
                    <td>{{ $voter->admission_number }}</td>
                </tr>
                <tr>
                    <td>Roll Number</td>
                    <td>{{ $voter->roll_number }}</td>
                </tr>
                <tr>
                    <td>UID</td>
                    <td>{{ $voter->uid }}</td>
                </tr>
                <tr>
                    <td>Standard</td>
                    <td>{{ $voter->standard->name }}</td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td>{{ date('d-m-Y', strtotime($voter->birth_date)) }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $voter->gender() }}</td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{ date('d-m-Y', strtotime($voter->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{ date('d-m-Y', strtotime($voter->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Created by</td>
                    <td>{{ $voter->user->name ?? '' }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection