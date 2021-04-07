@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('notifications.index')}}">Notifications</a>
        </li>
        <li class="breadcrumb-item active">Notification Details</li>
    </ol>
@endsection

@section('content')
    <h4>Notification Details</h4>
    <hr>
    @include('layouts.includes.notifications.navigation')
    <div class="row">
        <div class="col-12 mt-2">
           <div class="notifications-subject">
               <h2>{{$notification->subject}}</h2>
               <p class="notification-timestamp"><b>Created at:</b> <span>{{$notification->created_at }}</span> <b>Last time modified:</b> <span>{{$notification->updated_at->diffForHumans()}}</span></p>
           </div>
            <div class="notifications-content">
                <div class="form-group notification-content">
                    {!! $notification->notification_content !!}
                </div>
            </div>
        </div>
    </div>
    <div class="actions">
        <a href="{{url()->previous()}}"><button type="button" class="btn btn-dark">Back</button></a>
        <a href="{{ route('notifications.edit', ['id' => $notification->id]) }}"><button type="button" class="btn btn-info">Edit</button></a>
    </div>
    @include('layouts.includes.notifications')

@endsection
