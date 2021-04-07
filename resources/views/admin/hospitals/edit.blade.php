@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('hospitals.index')}}">Hospitals</a>
        </li>
        <li class="breadcrumb-item active">Edit Hospital</li>
    </ol>
@endsection

@section('content')
    <h4>Edit Hospital</h4>
    <hr>
    @include('layouts.includes.hospitals.navigation')

    <div class="col-12">
        <form action="{{route('hospitals.update')}}" method="POST" enctype="multipart/form-data" id="edit-hospital-form" class="forms">
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value="{{$hospital->id}}">
                <label for="name">Name of the Institution:</label> @error('name')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="name" class="form-control" value="{{ $hospital->name }}">
            </div>
            <div class="form-group">

                <label for="serial_number">Serial Number:</label> @error('serial_number')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="serial_number" class="form-control" value="{{ $hospital->serial_number }}">
                <small id="serial-number-info" class="form-text text-muted">Must contains 8 characters</small>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <img src="{{$hospital->image_path}}" class="hospital-cover img-fluid"
                             alt="Hospital Building Cover Image">
                        <p class="text-center"><small class="text-left">{{$hospital->name}}</small></p>
                    </div>
                    <div class="col-5">
                        <h3>Change picture:</h3>
                        <label for="image">Upload new picture</label> @error('image')<span
                            class="text-danger">* {{$message}}</span> @enderror
                        <input type="file" name="image" class="form-control-file">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <a href="{{route('hospitals.management')}}">
                                    <button type="button" class="btn btn-dark">Back</button>
                                </a>
                                <input type="submit" name="submit" id="submit" value="Edit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection
