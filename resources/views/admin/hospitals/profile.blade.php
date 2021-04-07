@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('hospitals.index')}}">Hospitals</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
@endsection

@section('content')
    <h4>Profile Details</h4>
    <hr>
    @include('layouts.includes.hospitals.navigation')
    <div class="row">
        <div class="col-6">
            <img src="{{asset($hospital->image_path)}}" class="hospital-cover img-fluid" alt="Hospital Building Cover Image">
            <p class="text-center"><small class="text-left">{{$hospital->name}}</small></p>
        </div>
        <div class="col-5">
            <table class="table hospital-main-details" >
                <tbody>
                <tr>
                    <th scope="row">Name:</th>
                    <td>{{$hospital->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Serial Number:</th>
                    <td><b>{{$hospital->serial_number}}</b></td>
                </tr>
                <tr>
                    <th scope="row">Record Timestamp:</th>
                    <td>{{$hospital->created_at}}</td>
                </tr>
                <tr>
                    <th scope="row">Last Record change:</th>
                    <td>{{$hospital->updated_at}}</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td><a href="{{route('hospitals.management')}}"><button type="button" class="btn btn-dark">Back</button></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.includes.notifications')

@endsection
