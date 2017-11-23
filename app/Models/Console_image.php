<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Console_image extends Model
{
	const IMAGE_LOCATION = "uploads/console";
    
    protected $fillable = ['images','console_id','name','slug'];

    // index page 

    public function saveImages($image, $id,$name)
    {

    	
    	$console = new Console_image;
    	$console->images = $image;
    	$console->console_id = $id;
    	$console->name = $name;
    	$console->save();
    	return true;
    }

}
