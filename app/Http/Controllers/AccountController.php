<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;


class AccountController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {   
	    //GET THE USER ID FROM SESSION
		$user_id = \Auth::user()->id;
		
        $user = User::find($user_id);
		
        return view('account.index',compact('user'));
		
    }
	
	public function editaccount(Request $request) { 
	    
	   if ( $request->ajax() ) { 
	   
	     //GET THE USER ID FROM SESSION
		 
		  $user_id = \Auth::user()->id;
		  
		  $user = User::find($user_id);

		  $check = User::where('email',$request->email)->get();
		  
		  //if the email in the request and in the database is the same no need to validate
		  if (count($check)) { 
		        $this->validate($request, [
				 'name'     => 'required|max:70',
			   ]);
		  } else { 
		  
		       //If the the validation fails it will return a 422 Unprocessable Entity
			   $this->validate($request, [
				 'name'     => 'required|max:30',
				 'email'    => 'required|email|unique:users|max:100',
			  ]);
		  
		  }
	      
		  $user->name  = $request->name;
		  $user->email = $request->email;
		 if( $user->save() ) { 
		 
		      $returnData = array(
               'status' => 'success',
               'message' => 'Your Details has been modified'
              );
            return response()->json($returnData, 200);
		 }
	    
	   }

		
	
	}

  	public function changepassword(Request $request) { 
	 
	    if ( $request->ajax() ) { 
	   
		   //GET THE USER ID FROM SESSION
		   
			$user_id = \Auth::user()->id;
			
			$user    = User::find($user_id);
			
			
			 //If the the validation fails it will return a 422 Unprocessable Entity
			$this->validate($request, [
				 'password'     => 'required|confirmed|max:90',
			     'password_confirmation' => 'required|min:3',
			 ]);
			 
			 $user->password = bcrypt($request->password);
			 
			 if( $user->save() ) { 
		 
		      $returnData = array(
               'status' => 'success',
               'message' => 'Your Password has been modified'
              );
            return response()->json($returnData, 200);
		 }
			
		}
	
	   return view('account.changepassword',compact('user'));

	}

   

    
}
