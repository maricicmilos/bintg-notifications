@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('hospitals.index')}}">Roles</a>
        </li>
        <li class="breadcrumb-item active">New Role</li>
    </ol>
@endsection

@section('content')
    <h4>New Role</h4>
    <hr>
    @include('layouts.includes.roles.navigation')

    <div class="col-12">
        <form action="{{route('roles.store')}}" method="POST" id="add-role-form" class="forms">
            @csrf
            <div class="form-group">
                <label for="name">Define name of the Role:</label> @error('name')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                       placeholder="Enter Role Name">
            </div>
            <input type="submit" name="submit" id="submit" value="Create" class="btn btn-primary">

        </form>
    </div>
    @include('layouts.includes.notifications')

@endsection
