@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('roles.index')}}">Roles</a>
        </li>
        <li class="breadcrumb-item active">Manage Roles Records</li>
    </ol>
@endsection

@section('content')
    <h4>Manage Roles Records</h4>
    <hr>
    @include('layouts.includes.roles.navigation')

    <table class="table table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if (count($roles))
            @foreach($roles as $role)
                <tr>
                    <th scope="row" class="text-center">{{$role->id}}</th>
                    <td>{{$role->name}}</td>
                    <td>
                        <a href="{{route('roles.edit', ['id' => $role->id]) }}"><button type="button" class="btn btn-info">Edit</button></a>
                        <form action="{{route('roles.delete', ['id' => $role->id])}}" method="POST" class="d-inline">
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
