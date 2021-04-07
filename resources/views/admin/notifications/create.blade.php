@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('notifications.index')}}">Notifications</a>
        </li>
        <li class="breadcrumb-item active">New Notifications</li>
    </ol>
@endsection

@section('content')
    <h4>New Notification</h4>
    <hr>
    @include('layouts.includes.notifications.navigation')

    <div class="col-12">
        <form action="{{route('notifications.store')}}" method="POST" id="create-notification-form" class="forms" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="subject">Subject:</label> @error('subject')<span class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="Enter Notification Subject">
            </div>

            <div class="form-group">
                <label for="recipients">Choose Recipients Group:</label>@error('recipients')<span class="text-danger">* {{$message}}</span> @enderror
                <select multiple class="form-control" name="recipients[]">
                    @foreach($specialties as $id => $specialty)
                        <option value="{{$id}}">{{$specialty}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="notification_content">Content:</label> @error('notification_content')<span class="text-danger">* {{$message}}</span> @enderror
                <textarea class="ckeditor form-control" id="ckeditor" name="notification_content"></textarea>
            </div>

            <input type="submit" name="submit" id="submit" value="Create" class="btn btn-primary">

        </form>
    </div>
    @include('layouts.includes.notifications')

@endsection

@section('custom_script')
    @include('layouts.includes.ckeditor')
@endsection
