@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('specialties.index')}}">Specialties</a>
        </li>
        <li class="breadcrumb-item active">Manage Specialties Records</li>
    </ol>
@endsection

@section('content')
    <h4>Manage Specialties Records</h4>
    <hr>
    @include('layouts.includes.specialties.navigation')

    <table class="table table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if (count($specialties))
            @foreach($specialties as $specialty)
                <tr>
                    <th scope="row" class="text-center">{{$specialty->id}}</th>
                    <td>{{$specialty->name}}</td>
                    <td>
                        <a href="{{route('specialties.edit', ['id' => $specialty->id]) }}"><button type="button" class="btn btn-info">Edit</button></a>
                        <form action="{{route('specialties.delete', ['id' => $specialty->id])}}" method="POST" class="d-inline">
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
