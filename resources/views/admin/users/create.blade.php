@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('users.index')}}">Users</a>
        </li>
        <li class="breadcrumb-item active">New User</li>
    </ol>
@endsection

@section('content')
    <h4>New User</h4>
    <hr>
    @include('layouts.includes.users.navigation')

    <div class="col-12">
        <form action="{{route('users.store')}}" method="POST" id="add-user-form" class="forms">
            @csrf
            <div class="form-group">
                <label for="firstname">First Name:</label> @error('firstname')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}"
                       placeholder="Enter User First Name">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label> @error('lastname')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}"
                       placeholder="Enter User Last Name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label> @error('email')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                       placeholder="Email: user@example.com">
            </div>

            <div class="form-group">
                <label for="specialty_id">Specialty:</label> @error('specialty_id')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <select class="form-control" name="specialty_id">
                    @foreach($specialties as $id => $specialty)
                        <option value="{{$id}}" selected>{{$specialty}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hospital_id">Hospital:</label> @error('hospital_id')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <select class="form-control" name="hospital_id">
                    @foreach($hospitals as $id => $hospital)
                        <option value="{{$id}}" selected>{{$hospital}}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" name="submit" id="submit" value="Create" class="btn btn-primary">
        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection
