@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
@endsection

@section('content')
    <h4>Roles</h4>
    <hr>
    @include('layouts.includes.roles.navigation')

    @if(!$hasRecords)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>There are no Role records in database. Please define at least one fallowing
                'New Role' <a href="{{ route('roles.create') }}">link</a></strong>
        </div>
    @endif

    @include('layouts.includes.notifications')
@endsection
