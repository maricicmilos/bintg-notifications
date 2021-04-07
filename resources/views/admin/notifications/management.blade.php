@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('notifications.index')}}">Notifications</a>
        </li>
        <li class="breadcrumb-item active">Manage Notifications Records</li>
    </ol>
@endsection

@section('content')
    <h4>Manage Notifications Records</h4>
    <hr>
    @include('layouts.includes.notifications.navigation')

    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Subject</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if (count($notifications))
            @foreach($notifications as $notification)
                <tr>
                    <th scope="row" class="text-center">{{$notification->id}}</th>
                    <td><b>{{$notification->subject}}</b></td>
                    <td>
                        <a href="{{route('notifications.view', ['id' => $notification->id]) }}">
                            <button type="button" class="btn btn-light">Details</button>
                        </a>
                        <a href="{{route('notifications.edit', ['id' => $notification->id]) }}">
                            <button type="button" class="btn btn-info">Edit</button>
                        </a>
                        <form action="{{route('notifications.delete', ['id' => $notification->id])}}" method="POST" class="d-inline">
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
