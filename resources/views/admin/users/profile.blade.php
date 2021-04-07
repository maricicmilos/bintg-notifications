@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('users.index')}}">Users</a>
        </li>
        <li class="breadcrumb-item active">User Profile</li>
    </ol>
@endsection

@section('content')
    <h4>User Profile Details</h4>
    <hr>
    @include('layouts.includes.users.navigation')
    <div class="row">
        <div class="col-12">
            <table class="table hospital-main-details" >
                <tbody>
                <tr>
                    <th scope="row">USER ID:</th>
                    <td>{{$user->id}}</td>
                </tr>
                <tr>
                    <th scope="row">First Name:</th>
                    <td>{{$user->firstname}}</td>
                </tr>
                <tr>
                    <th scope="row">Last Name:</th>
                    <td>{{$user->lastname}}</td>
                </tr>
                <tr>
                    <th scope="row">Email:</th>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <th scope="row">Role:</th>
                    <td><b>{{$user->role->name}} ( <i>{{$user->specialty->name}}</i> )</b></td>
                </tr>
                <tr>
                    <th scope="row">Hospital:</th>
                    @if(!$hospital)
                        <td><b>No Dedicated Hospital</b></td>
                    @else
                        <td><b>{{$hospital->name}}</b></td>
                    @endif
                </tr>
                <tr>
                    <th scope="row">Created at:</th>
                    <td>{{$user->created_at}}</td>
                </tr>
                <tr>
                    <th scope="row">Last Record change:</th>
                    <td>{{$user->updated_at}}</td>
                </tr>
                <tr>
                    <th scope="row">Verified account:</th>
                    @if($user->email_verified_at)
                        <td>{{$user->email_verified_at->diffForHumans()}}</td>
                    @else
                        <td><span class="alert-danger p-2 rounded">Account is waiting confirmation</span></td>
                    @endif
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td><a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-dark">Back</button>
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.includes.notifications')

@endsection
