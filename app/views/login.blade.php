<!DOCTYPE HTML>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf8" />

    <body class="bzw">
    
       <div class="body">
<form method="post" action="{{ route('signin') }}" class="form-horizontal form-signin">
  <!-- CSRF Token -->
  <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}" />
  
  <h2 class="form-signin-heading" style="background:#298A08;">Welcome to Taka app blog</h2>
  <div class="login-wrap">
    <!-- Email -->
    <div class="control-group{{ $errors->first('email', ' error') }}">
      <input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email') }}" placeholder="john.doe@email.com"/>
      {{ $errors->first('email', '<span class="help-block">:message</span>') }}
    </div>

    <!-- Password -->
    <div class="control-group{{ $errors->first('password', ' error') }}">
      <input class="form-control" type="password" name="password" id="password" value="" placeholder="Password"/>
      {{ $errors->first('password', '<span class="help-block">:message</span>') }}
    </div>

    <!-- Remember me -->
    <div class="control-group">
      

      <a href="{{ route('forgot-password') }}" class="btn btn-link">Forgot Password</a>
    </div>

    <!-- Form actions -->
    <div class="control-group">
      <button type="submit" class="btn btn-lg btn-login btn-block">Sign in</button>
    </div>
    

    <div class="registration">
            Dont have an Account?
            <a class="pull-right" href="{{ route('signup') }}">
                Sign Up Here
            </a>
        </div>