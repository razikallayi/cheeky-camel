@extends('auth.layout')

@section('body-name','login-page')

@section('content')
<div class="card">
    <div class="body">
       <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="msg"><p class="lead text-center">Sign In</p></div>

        <div class="logo">

            <a href="{{ url(config('whyte.project.link')) }}"><img src="{{ url(config('whyte.project.logo')) }}"></a>
            <small>{{ config('whyte.project.subname') }}</small>
        </div>

        <div class="form-group p-l-20 {{ $errors->has('username') ? ' has-error' : '' }}">
            <label for="username" class="control-label">Username</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">person</i>
                </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                </div>
            </div>
            
            @if ($errors->has('username'))
            <span class="help-block">
               <strong>{{ $errors->first('username') }}</strong>
           </span>
           @endif
       </div>

       <div class="form-group p-l-20 {{ $errors->has('password') ? ' has-error' : '' }}">

        <label for="password" class="control-label">Password</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
        </div>
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    

    <div class="row">
        <div class="col-xs-8 p-t-5">
            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-amber">
            <label for="rememberme">Remember Me</label>
        </div>
        <div class="col-xs-4">
            <button class="btn btn-block bg-amber waves-effect" type="submit">SIGN IN</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
                      <!--   <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div> -->
                        <div class="col-xs-12 align-right">
                            <a href="{{ url('/password/reset') }}">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endsection


        @section('scripts')
        @parent
        <script src="{{url('assets/admin/js/pages/examples/sign-in.js')}}"></script>
        @endsection