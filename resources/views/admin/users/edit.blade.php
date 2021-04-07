@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('users.index')}}">Users</a>
        </li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>
@endsection

@section('content')
    <h4>Edit User</h4>
    <hr>
    @include('layouts.includes.users.navigation')

    <div class="col-12">
        <form action="{{route('users.update')}}" method="POST" id="add-user-form" class="forms">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">

            <div class="form-group">
                <label for="firstname">First Name:</label> @error('firstname')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label> @error('lastname')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label> @error('email')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="role">Set User Role:</label> @error('role')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <select class="form-control" name="role_id">
                    @foreach($roles as $id => $role)
                        @if($id === $user->role->id)
                            <option value="{{$id}}" selected>{{$role}}</option>
                        @else
                            <option value="{{$id}}">{{$role}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="specialty">Set User Specialty:</label> @error('specialty')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <select class="form-control" name="specialty_id">
                    @foreach($specialties as $id => $specialty)
                        @if($id === $user->specialty->id)
                            <option value="{{$id}}" selected>{{$specialty}}</option>
                        @else
                            <option value="{{$id}}">{{$specialty}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if($userHospital)
                <div class="form-group">
                    <label for="hospital_id">Set Hospital:</label> @error('hospital_id')<span
                        class="text-danger">* {{$message}}</span> @enderror
                    <select class="form-control" name="hospital_id">
                        @foreach($hospitals as $id => $hospital)
                            @if($id === $userHospital->id)
                                <option value="{{$id}}" selected>{{$hospital}}</option>
                            @else
                                <option value="{{$id}}">{{$hospital}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif

            <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary">
        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection
