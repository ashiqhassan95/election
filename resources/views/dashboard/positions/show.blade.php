@extends('dashboard.layouts.master', ['selected_nav' => 'positions'])
@section('title')
    Show Position
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col">
            <table width="300">
                <tr>
                    <td>Title</td>
                    <td>{{ $position->title }}</td>
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{ date('d-m-Y', strtotime($position->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{ date('d-m-Y', strtotime($position->updated_at)) }}</td>
                </tr>
                <tr>
                    <td>Created by</td>
                    <td>{{ $position->user->name ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection