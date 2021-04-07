@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('hospitals.index')}}">Hospitals</a>
        </li>
        <li class="breadcrumb-item active">Manage Hospital Records</li>
    </ol>
@endsection

@section('content')
    <h4>Manage Hospital Records</h4>
    <hr>
    @include('layouts.includes.hospitals.navigation')

    <table class="table table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Serial Number</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @if (count($hospitals))
            @foreach($hospitals as $hospital)
                <tr>
                    <th scope="row" class="text-center">{{$hospital->id}}</th>
                    <td class="text-center"><b>{{$hospital->serial_number}}</b></td>
                    <td>{{$hospital->name}}</td>
                    <td>
                        <a href="{{route('hospitals.view', ['id' => $hospital->id]) }}"><button type="button" class="btn btn-light">Details</button></a>
                        <a href="{{route('hospitals.edit', ['id' => $hospital->id]) }}"><button type="button" class="btn btn-info">Edit</button></a>
                        <form action="{{route('hospitals.delete', ['id' => $hospital->id])}}" method="POST" class="d-inline">
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
