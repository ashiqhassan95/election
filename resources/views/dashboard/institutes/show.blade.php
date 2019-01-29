@extends('dashboard.layouts.master', ['selected_nav' => 'institutes'])
@section('title')
    Show Institute
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col">
            <table width="600">
                <tr>
                    <td>Name</td>
                    <td>{{ $institute->name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $institute->address }}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{ $institute->city }}</td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>{{ $institute->state }}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{ $institute->country }}</td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{ date('d-m-Y', strtotime($institute->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{ date('d-m-Y', strtotime($institute->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Created by</td>
                    <td>{{ $institute->user->name ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection