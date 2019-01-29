@extends('dashboard.layouts.master', ['selected_nav' => 'standards'])
@section('title')
    Show Standard
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col">
            <table width="300">
                <tr>
                    <td>Name</td>
                    <td>{{ $standard->name }}</td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{ date('d-m-Y', strtotime($standard->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{ date('d-m-Y', strtotime($standard->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Created by</td>
                    <td>{{ $standard->user->name ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection