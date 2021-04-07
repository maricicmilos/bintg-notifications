@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Specialties</li>
    </ol>
@endsection

@section('content')
    <h4>Specialties</h4>
    <hr>
    @include('layouts.includes.specialties.navigation')

    @if(!$hasRecords)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>There are no Specialties records in database. Please define at least one fallowing
                'New Specialty' <a href="{{ route('specialties.create') }}">link</a></strong>
        </div>
    @endif

    @include('layouts.includes.notifications')
@endsection
