<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Gift extends Model
{
    //
	protected $fillable =['category','title','image'];

	const IMAGE_LOCATION="uploads/gifts";

	public function category()
	{
		return $this->hasOne('App\Models\Gift_category','id','category');
	}

	public function saveGifts($request)
	{
		$gift = new Gift;
		$gift->category = $request->category;
		$gift->title = $request->title;
		$gift->image = $request->image[0];
		$gift->save();
		return true;
	}


	public static function getGifts($id=null)
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



	//updateGift

	public function updateGift($request )
	{

		$gift=Gift::findOrFail($request->id);
		$gift->title=$request->title;
		
		if(isset($request->image)){


			if(!is_null($gift->image)){
				if(file_exists(self::IMAGE_LOCATION.$gift->image)){
					unlink(self::IMAGE_LOCATION.$gift->image);
				}
			}

			if(is_array($request->image)){
				$gift->image = $request->image[0];
			}else{
				$gift->image = $request->image;
			}

		}
		
		$gift->save();
		
		return true;
	}


	// gift deletes 


	public static function deleteGifts($id)
	{
		$gift = self::findOrFail($id);
		$myfile = Gift::IMAGE_LOCATION.'/'.$gift->image;


				if(File::exists($myfile))
				{
					unlink($myfile);
					
				}
		$gift->delete();
		return true;
	}


}
