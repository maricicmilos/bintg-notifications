@extends('layouts.dashboard_doctors')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('doctor.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Notification</li>
    </ol>
@endsection

@section('content')
    <h4>Notification</h4>
    <hr>
    @include('layouts.includes.doctors.navigation')

    <div class="row">
        <div class="col-10">
            <div class="notifications-subject">
                <h4>{{$notification->subject}}</h4>
                <p><b>Created at:</b> <span>{{$notification->created_at }}</span> <b>Last time modified:</b> <span>{{$notification->updated_at->diffForHumans()}}</span></p>
            </div>
            <div class="notifications-content">
                {!! $notification->notification_content !!}
            </div>
        </div>
    </div>
    <div class="actions">
        <a href="{{url()->previous()}}"><button type="button" class="btn btn-dark">Back</button></a>
    </div>

    @include('layouts.includes.notifications')
@endsection

