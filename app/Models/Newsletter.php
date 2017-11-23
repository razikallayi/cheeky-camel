<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = ['description','users'];

     // store newsletters

    public static function storeNewsletter($request)
    {
    	
    	$news = new Newsletter;
    	$news->description = $request->description;
    	if(isset($request->users))
    	{
    		$news->users = $request->users;
    	}
    	$news->save();
    	return true;
    	
    	//$res = self::getSubscribedLists();
    	
    	//$subscribe->
    }

    // get newsletters

    public static function getNewsletters($id=null)
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

}
