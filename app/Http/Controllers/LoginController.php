<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Models\Registration;
use Redirect;
use Session;

class LoginController extends Controller
{
    // login home 

  public function loginHome(Request $request)
  {

   $register = new Registration;
   $this->validate($request,[
    'email' => 'required' ,
    'password' => 'required' ,
    ]);
   $result = $register->checkCredentials($request); 

   if($result != "")
   {  

    Session::put('user_id',$result['id']);
    Session::put('user_email', $result['email']);
    Session::put('password', $result['password']);
    Session::flash('success_login','Hey !! You are logged in successfully !!');
    return Redirect::to('/users/login');
  }
  else 
  {

    Session::flash('log_fail','Oops... Please try with valid details!! ');
    return Redirect::to('/');
  }

}

    // after successfull login , user entering this page


public function userLogin()
{

  if(Session::has('user_id'))
  {
    $id = Session::get('user_id');
    $registration = Registration::getRegistrationDetails($id);
  
    return view('cheekycamel.user.index',compact('registration'));
  }
  else
  {
    return view('cheekycamel.user.index');  
  }

}



// after click logout 

public function signOut()
{
  Session::flush();
  return Redirect::to('/');
}


// save account details 


public function saveProfile(Request $request)
{
  $id = Session::get('user_id');

  $register = new Registration;
  $register->saveAccount($request,$id);
  return back();
}

// save password 


public function savePassword(Request $request)
{
  $id = Session::get('user_id');

  $register = new Registration;
  $register->changePassword($request , $id);
  return back();
}


}
