@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('hospitals.index')}}">Hospitals</a>
        </li>
        <li class="breadcrumb-item active">New Hospital</li>
    </ol>
@endsection

@section('content')
    <h4>New Hospital</h4>
    <hr>
    @include('layouts.includes.hospitals.navigation')

    <div class="col-12">
        <form action="{{route('hospitals.store')}}" method="POST" enctype="multipart/form-data" id="add-hospital-form"
              class="forms">
            @csrf
            <div class="form-group">
                <label for="name">Name of the Institution:</label> @error('name')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                       placeholder="Enter Hospital Name">
            </div>

            <div class="form-group">
                <label for="serial_number">Serial Number:</label> @error('serial_number')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number') }}"
                       placeholder="Enter Serial Number">
                <small id="serial-number-info" class="form-text text-muted">Must contains 8 characters</small>
            </div>

            <div class="form-group">
                <label for="image">Upload picture</label> @error('image')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="file" name="image" class="form-control-file">
            </div>

            <input type="submit" name="submit" id="submit" value="Create" class="btn btn-primary">

        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection
