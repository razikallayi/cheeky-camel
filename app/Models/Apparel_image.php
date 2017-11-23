<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apparel_image extends Model
{
    const IMAGE_LOCATION ="uploads/apparels";

    protected $fillable = ['images','apparel_id','name','slug'];

    // save data 

    public function saveData($image , $id , $name )
    {
    	$apparel = new Apparel_image;
    	$apparel->images = $image;
    	$apparel->apparel_id = $id;
    	$apparel->name= $name;
    	$apparel->save();
    	return true;
    	
    }

}
