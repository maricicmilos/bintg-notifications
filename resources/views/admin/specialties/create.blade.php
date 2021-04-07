@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('specialties.index')}}">Specialties</a>
        </li>
        <li class="breadcrumb-item active">New Specialty</li>
    </ol>
@endsection

@section('content')
    <h4>New Specialty</h4>
    <hr>
    @include('layouts.includes.specialties.navigation')

    <div class="col-12">
        <form action="{{route('specialties.store')}}" method="POST" id="add-specialty-form" class="forms">
            @csrf
            <div class="form-group">
                <label for="name">Define Specialty:</label> @error('name')<span
                    class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                       placeholder="Enter Specialty Name">
            </div>
            <input type="submit" name="submit" id="submit" value="Create" class="btn btn-primary">

        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection
