<!DOCTYPE html>
<html lang="en">

  @include('layouts.includes.header')

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="POST" action="{{ route('auth.authenticate') }}">
              @csrf
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
              @error('email')<small class="text-danger">* {{$message}}</small> @enderror
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
              @error('password')<small class="text-danger">* {{$message}}</small> @enderror
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me"> Remember Password</label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Login" />
          </form>
          <div class="text-center">
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  </body>

</html>
