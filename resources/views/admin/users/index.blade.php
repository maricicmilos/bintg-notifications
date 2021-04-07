@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
@endsection

@section('content')
    <h4>Users</h4>
    <hr>
    @include('layouts.includes.users.navigation')

    @include('layouts.includes.notifications')
@endsection
