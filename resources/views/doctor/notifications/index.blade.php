@extends('layouts.dashboard_doctors')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('doctor.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Notifications</li>
    </ol>
@endsection

@section('content')
    <h4>Notifications</h4>
    <hr>
    @include('layouts.includes.doctors.navigation')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Notification subject</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($doctorNotifications as $notification)
            <tr>
                <td>{{$notification->subject}}</td>
                <td>{{$notification->created_at}}</td>
                <td>
                    <a href="{{route('doctors.read', ['id' => $notification->notification_id])}}">Read Content</a>
                    @if(in_array($notification->notification_id, $seenNotificationsIds))
                        <span>  |  Seen</span>
                    @else
                        <span>  |  </span>
                        <a href="{{route('doctors.seen', ['id' => $notification->notification_id])}}">Mark as Seen</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @include('layouts.includes.notifications')
@endsection

