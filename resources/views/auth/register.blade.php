@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" id="registerForm" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div id="register-name" class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                               <span class="help-block">
                                        <strong id="register-errors-name"></strong>
                                 </span>
                            </div>
                        </div>

                        <div id="register-email" class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    <span class="help-block">
                                        <strong id="register-errors-email"></strong>
                                    </span>
                            </div>
                        </div>

                        <div id="register-password" class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                             
                                    <span class="help-block">
                                        <strong id="register-errors-password"></strong>
                                    </span>
                              
                            </div>
                        </div>

                        <div id="confirm-password" class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    <span class="help-block">
                                        <strong id="form-errors-password-confirm"></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" data-loading-text="Loading..." id="register-button" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

window.onload = function ( ) {
	

        var registerForm = $("#registerForm");
		
        registerForm.submit(function(e){
            e.preventDefault();
            var formData = registerForm.serialize();
             $( '#register-errors-name' ).html( "" );
             $( '#register-errors-email' ).html( "" );
             $( '#register-errors-password' ).html( "" );
             $("#register-name").removeClass("has-error");
             $("#register-email").removeClass("has-error");
             $("#register-password").removeClass("has-error");

            $.ajax({
                url:'/register',
                type:'POST',
                data:formData,
				beforeSend: function(){ 
				   $('#register-button').button('loading');
				},complete: function() {
					
			       $('#register-button').button('reset');
		        },
                success:function(data){
                    location.reload(true);
                },
                error: function (data) {
                    var obj = jQuery.parseJSON( data.responseText );

                   if(obj.name){
                        $("#register-name").addClass("has-error");
                        $( '#register-errors-name' ).html( obj.name );
                    }
                    if(obj.email){
                        $("#register-email").addClass("has-error");
                        $( '#register-errors-email' ).html( obj.email );
                    }
                    if(obj.password){
                        $("#register-password").addClass("has-error");
                        $( '#register-errors-password' ).html( obj.password );
                    }
                }
            });
        });
	
	
}


</script>
@endsection
