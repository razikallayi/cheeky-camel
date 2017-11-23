<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribeduser extends Model
{
	protected $fillable = ['email'];
    
    // check with lists 

	public static function checkSubscribedList($request)
	{
		$subscribe = Subscribeduser::where('email',$request->email)->count();
		return $subscribe;
	}

	// store in lists

    public static function storeSubcribers($request)
    {
    	$subscribe = new Subscribeduser;
    	$subscribe->email = $request->email;
    	$subscribe->save();
    	return true;

    }

    //get users

    public static function getSubscribedLists($id = null)
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

    // delete lists 

    public function deleteSubscribers($id)
    {
    	$subscribe= Subscribeduser::findOrFail($id);
    	$subscribe->delete();
    	return true;
    }

   }
