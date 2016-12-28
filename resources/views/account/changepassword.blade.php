@extends('layouts.app')

@section('content')
<style>
  img {
    max-width: 100%;
  }
</style>
<div class="container">
    <div class="row">

      <h2>Your Account</h2>
      <hr>
        <div class="col-md-3">
           <ul class="list-group">
              <a href="/myaccount"> <li class=" list-group-item">
                Edit Account
              </li>
              </a>
               <a href="/changepassword"><li class="active list-group-item">
               Change Password
              </li>
              </a>
              <a href="/posts"><li class="list-group-item">
                <span class="badge">14</span>
               Post
              </li></a>
               <a href="/transaction"><li class="list-group-item">
                <span class="badge">14</span>
               Transaction
              </li></a>
              
           </ul>

         
        </div>
        
        <div class="col-md-9">
        <div id="result"></div>
       
      <form action="" id="changepasswordForm" method="post" enctype="multipart/form-data" class="form-horizontal">
      {{csrf_field()}}
        <fieldset>
          <legend>Change Password</legend>
          <div id="chp-password" class="form-group required">
            <label class="col-sm-2 control-label" for="input-password">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
                <span class="help-block">
                 <strong id="chp-errors-password"></strong>
              </span>
             </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="password_confirmation" value="" placeholder="Password Confirm" id="input-confirm" class="form-control" />
             
             </div>
          </div>
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="" class="btn btn-default">Back</a></div>
          <div class="pull-right">
            <input type="submit" id="chp-button" value="Save" class="btn btn-primary" />
          </div>
        </div>
      </form>
        
        </div>
    </div>
</div>

<script>

window.onload = function ( ) {
	

        var registerForm = $("#changepasswordForm");
		
        registerForm.submit(function(e){
            e.preventDefault();
            var formData = registerForm.serialize();
             $('#chp-errors-password' ).html( "" );
             $("#chp-password").removeClass("has-error");
			 $("#result").removeClass('alert alert-success').html('');

            $.ajax({
                url:'/changepassword',
                type:'POST',
                data:formData,
				beforeSend: function(){ 
				   $('#chp-button').button('loading');
				},complete: function() {
			       $('#chp-button').button('reset');
		        },
                success:function(data){
                  if(data.message){
                        $("#result").addClass('alert alert-success').html(data.message);
                    }
                },
                error: function (data) {
                    var obj = jQuery.parseJSON( data.responseText );

                   if(obj.password){
                        $("#chp-password").addClass("has-error");
                        $( '#chp-errors-password' ).html( obj.password );
                    }
                   
                    
                }
            });
        });
	
	
}


</script>
@endsection
