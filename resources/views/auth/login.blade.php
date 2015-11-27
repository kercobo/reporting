<!-- resources/views/auth/login.blade.php -->
@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Please Sign In')
               @section ('login_panel_body')
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class="form-group">
        Username
        <input class="form-control" type="username" name="username" value="{{ old('username') }}">
    </div>

   <div class="form-group">
        Password
        <input class="form-control" type="password" name="password" id="password">
    </div>

     <div class="checkbox">
     <label>
                                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                            </label>
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop