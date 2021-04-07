<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Account Confirmation Page</title>

    <!-- Bootstrap core CSS-->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Welcome to the Hospital Central Management System</div>
        <div class="card-body">
            <p>You have successfully confirmed Your Account</p>
            <form action="{{ route('auth.password.set') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{$authUser->email}}">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" class="form-control" value="{{$authUser->email}}" placeholder="Email address" required="required" autofocus="autofocus" readonly>
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <p>Please provide unique password and use it as your credentials data</p>
                @error('password')<p class="text-danger">* {{$message}}</p> @enderror
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Enter Password" required="required">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password_confirmation" id="inputRePassword" class="form-control" placeholder="Reenter Password for verification" required="required">
                        <label for="inputPassword">Repeat Password</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me">
                            Remember Password
                        </label>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Continue" />
            </form>
            <div class="text-center">
                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
@include('layouts.includes.notifications')

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

</body>

</html>
