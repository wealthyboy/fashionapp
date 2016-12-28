@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form id="loginForm" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div id="email" class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    <span class="help-block">
                                        <strong id="form-errors-email"></strong>
                                    </span>
                            </div>
                        </div>

                        <div id="password" class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                    <span class="help-block">
                                        <strong id="form-errors-password"></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                        
                        <div class="form-group" id="login-errors">
                            <span class="help-block">
                                <strong id="form-login-errors"></strong>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

window.onload = function ( ) {
	
	   var loginForm = $("#loginForm");
         loginForm.submit(function(e) {
		  e.preventDefault();
		  var formData = loginForm.serialize();
		  $('#form-errors-email').html("");
		  $('#form-errors-password').html("");
		  $('#form-login-errors').html("");
		  $("#email").removeClass("has-error");
		  $("#password").removeClass("has-error");
		  $("#login-errors").removeClass("has-error");
		  $.ajax({
			  url: '/login',
			  type: 'POST',
			  data: formData,
			  success: function(data) {
				  location.reload(true);
			  },
			  error: function(data) {
				  console.log(data.responseText);
				  var obj = jQuery.parseJSON(data.responseText);
				  if (obj.email) {
					  $("#email").addClass("has-error");
					  $('#form-errors-email').html(obj.email);
				  }
				  if (obj.password) {
					  $("#password").addClass("has-error");
					  $('#form-errors-password').html(obj.password);
				  }
				  if (obj.error) {
					  $("#login-errors").addClass("has-error");
					  $('#form-login-errors').html(obj.error);
				  }
			  }
		  });
});

}


</script>
@endsection
