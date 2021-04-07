@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Hospitals</li>
    </ol>
@endsection

@section('content')
    <h4>Hospitals</h4>
    <hr>
    @include('layouts.includes.hospitals.navigation')

    @if(!$hasRecords)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>There are no Hospital records in database. Please define at least one fallowing
                'New Hospital' <a href="{{ route('hospitals.create') }}">link</a></strong>
        </div>
    @endif

    @include('layouts.includes.notifications')
@endsection
