<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Registration;
use Validator;
use Session;
use Redirect;

class RegistrationController extends Controller
{


   // register here 

  public function registerData(Request $request)
  {

   $this->validate($request ,[
    'username' => 'required' ,
    'emails' => 'required' ,
    'password' => 'required',
    ]);
   $register = new Registration;

   $result = $register->savePost($request);
   if($result == true)
   {
    Session::flash('success', 'Thank You for register with us .');

     return Redirect::to('/');
  }
  else if($result == false)
  {
    Session::flash('failure', 'Oopss.. !! Email is already exists !! Try Another .. ');

    return Redirect::to('/');
  }

}


}
