@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('users.index')}}">Users</a>
        </li>
        <li class="breadcrumb-item active">Manage Users Records</li>
    </ol>
@endsection

@section('content')
    <h4>Manage Users Records</h4>
    <hr>
    @include('layouts.includes.users.navigation')

    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Role</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if (count($users))
            @foreach($users as $user)
                <tr>
                    <th scope="row" class="text-center">{{$user->id}}</th>
                    <td class="text-center"><b>{{$user->role->name}}</b></td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{route('users.view', ['id' => $user->id]) }}">
                            <button type="button" class="btn btn-light">Details</button>
                        </a>
                        <a href="{{route('users.edit', ['id' => $user->id]) }}">
                            <button type="button" class="btn btn-info">Edit</button>
                        </a>
                        <form action="{{route('users.delete', ['id' => $user->id])}}" method="POST" class="d-inline">
                            @csrf
                            <input type="submit" value="Delete" name="submit" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @include('layouts.includes.notifications')

@endsection
