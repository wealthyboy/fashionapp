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
              <a href="/myaccount"> <li class="active list-group-item">
                Edit Account
              </li>
              </a>
              
               <a href="/changepassword">
                 <li class="list-group-item">
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
        <form action="" id="editaccountForm" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}

        <fieldset>
          <legend>Edit Personal Details</legend>
          <div id="details-name" class="form-group required">
            <label class="col-sm-2 control-label" for="input-firstname">Name </label>
            <div class="col-sm-10">
              <input type="text" name="name" value="{{$user->name}}" placeholder="Name" id="input-firstname" class="form-control" />
              
                <span class="help-block">
                  <strong id="details-errors-name"></strong>
                </span>
            </div>
          </div>
        
          <div id="details-email" class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input type="email" name="email" value="{{$user->email}}" placeholder="E-Mail" id="input-email" class="form-control" />
              
               <span class="help-block">
                   <strong id="details-errors-email"></strong>
               </span>
            </div>
          </div>
         
          
                  </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="" class="btn btn-default">Back</a></div>
          <div class="pull-right">
            <input type="submit" id="account-details-button" data-loading-text="Loading..." value="Continue" class="btn btn-primary" />
          </div>
        </div>
      </form>
        
        </div>
    </div>
</div>

<script>

window.onload = function ( ) {
	

        var registerForm = $("#editaccountForm");
		
        registerForm.submit(function(e){
            e.preventDefault();
            var formData = registerForm.serialize();
             $( '#details-errors-name' ).html( "" );
             $( '#details-errors-email' ).html( "" );
             $("#details-name").removeClass("has-error");
             $("#details-email").removeClass("has-error");
            $.ajax({
                url:'/editaccount',
                type:'POST',
                data:formData,
				beforeSend: function(){ 
				   $('#account-details-button').button('loading');
				},complete: function() {
					
			       $('#account-details-button').button('reset');
		        },
                success:function(data){
                  if(data.message){
                        $("#result").addClass('alert alert-success').html(data.message).delay(3000).fadeOut();
                    }
                },
                error: function (data) {
                    var obj = jQuery.parseJSON( data.responseText );

                   if(obj.name){
                        $("#details-name").addClass("has-error");
                        $( '#details-errors-name' ).html( obj.name );
                    }
                    if(obj.email){
                        $("#details-email").addClass("has-error");
                        $( '#details-errors-email' ).html( obj.email );
                    }
                    
                }
            });
        });
	
	
}


</script>
@endsection
