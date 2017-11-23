<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Redirect;


class Registration extends Model
{
     //
	protected $fillable = ['username','email','phone','gender','password','role','is_subscribe'];

	public function savePost($request)
	{

		$register = new Registration;
		$email = $request->emails;
		$check_res =$this->checkPassword($email);
		if($check_res == true)
		{

			$register->username = $request->username;
			$register->email = $email;
			$register->password = sha1($request->password) ;
			$register->role = "user" ;
			$register->save();
			return true;
		}
		else if($check_res == false)
		{
			return false;
		}
		
		
	}

    // ################## checking password ################ //

	public static function checkPassword($email)
	{

		$result = self::where('email',$email)->first();

		if(is_null($result)) // incase of unique mail id
		{
			return true;
		}
		else
		{
			return false;
			
		}

	}

	// ################# registered user details ################ //
	
	public static function getRegistrationDetails($id =null)
	{
		if($id == null)
		{
			return self::get();
		}
		else
		{
			return self::findOrFail($id);
		} 
	}

	// ############## checking credentials ############### //



	public  function checkCredentials($request)
	{
		 
		$result = self::where(['email'=> $request->email ,'password' =>sha1($request->password) ])->first();
		
		$post_email = $request->email;
		$post_password = sha1($request->password);

		if($result)
		{

			$db_email = $result->email;
			$db_password = $result->password;
			$user_id = $result->id;

			if($post_email == $db_email && $post_password == $db_password)
			{

				$data = array(
					'id' => $user_id,
					'email' => $post_email,
					'password' => $post_password,
					);

				return $data;
			}
			else
			{

				return false;
			}
		}
	}


	// ########################## save account details ######################### //

	public function saveAccount($request , $id)
	{
		$reg = self::findOrFail($id);
		$reg->name = $request->name;
		$reg->email = $request->email;
		$reg->phone = $request->phone;
		$reg->gender = $request->gender;
		
		$reg->save();
		return true;

	}


	// ########################## save password here ########################### //


	public function changePassword($request , $id)
	{
		$reg = self::findOrFail($id);
		$current = $request->current_password;
		$new = $request->new_password;
		$confirm = $request->password ;
		if($new == $confirm)
		{
			
			$reg->password = sha1($new);
			$reg->save();
			return true;
		}


	}


	// ########################### ########################## // 

}
