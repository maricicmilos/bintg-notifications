@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('specialties.index')}}">Specialties</a>
        </li>
        <li class="breadcrumb-item active">Edit Specialty</li>
    </ol>
@endsection

@section('content')
    <h4>Edit Specialty</h4>
    <hr>
    @include('layouts.includes.specialties.navigation')

    <div class="col-12">
        <form action="{{route('specialties.update')}}" method="POST" id="edit-roles-form" class="forms">
            @csrf
            <input type="hidden" name="id" value="{{$specialty->id}}">

            <div class="form-group">
                <label for="name">Change Specialty Name:</label> @error('name')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="name" class="form-control" value="{{ $specialty->name }}">
            </div>

            <input type="submit" name="submit" id="submit" value="Edit" class="btn btn-primary">
        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection
