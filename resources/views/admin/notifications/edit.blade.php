@extends('layouts.dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('notifications.index')}}">Notifications</a>
        </li>
        <li class="breadcrumb-item active">Edit Notifications</li>
    </ol>
@endsection

@section('content')
    <h4>Edit Notifications</h4>
    <hr>
    @include('layouts.includes.notifications.navigation')

    <div class="col-12">
        <form action="{{route('notifications.update')}}" method="POST" id="add-user-form" class="forms">
            @csrf
            <input type="hidden" name="notification_id" value="{{$notification->id}}">

            <div class="form-group">
                <label for="subject">Subject:</label> @error('subject')<span class="text-danger">* {{$message}}</span> @enderror
                <input type="text" name="subject" class="form-control" value="{{ $notification->subject }}" placeholder="Enter Notification Subject">
            </div>

            <div class="form-group">
                <label for="recipients">Edit Recipients Group:</label>@error('recipients')<span class="text-danger">* {{$message}}</span> @enderror
                <select multiple class="form-control" name="recipients[]">
                    @foreach($specialities as $id => $specialty)
                        @if(in_array($specialty, $specialtiesFounded))
                            <option value="{{$id}}" selected>{{$specialty}}</option>
                        @else
                            <option value="{{$id}}">{{$specialty}}</option>
                        @endif
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="notification_content">Edit Notification Content:</label> @error('notification_content')<span class="text-danger">* {{$message}}</span> @enderror
                <textarea class="ckeditor form-control" id="ckeditor" name="notification_content">
                    {{ $notification->notification_content }}
                </textarea>
            </div>

            <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary">
        </form>
    </div>

    @include('layouts.includes.notifications')

@endsection

@section('custom_script')
    @include('layouts.includes.ckeditor')
@endsection
