<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartmodel extends Model
{
    protected $fillable = ['user_id','item_id','item_category','slug'];

    public static function saveData($userdata)
    {
    	
    	$carts = new cartmodel;
    	$carts->user_id = $userdata['userid'];
    	$carts->item_id = $userdata['itemid'];
    	$carts->item_category = $userdata['category'];
    	$carts->save();
    	return true;

    }
}
