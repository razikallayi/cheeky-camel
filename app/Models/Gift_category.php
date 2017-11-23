<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gift;

class Gift_category extends Model
{
	protected $fillable = ['category','slug'];

    //

	public function saveCategory($request)
	{
		$cats = new Gift_category;
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category);
		$cats->save();
		return true;
	}


	public static function getCategory($id=null)
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


	public static function updateCategory($request)
	{
		$cats = Gift_category::findOrFail($request->id);
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category) ;
		$cats->save();
		return true;
	}

	public static function deleteCategory($id)
	{
		$items = Gift::where('category',$id)->get();
		if(!$items->isEmpty())
		{
			return false;
		}
		else
		{
			$cats = Gift_category::findOrFail($id);
			$cats->delete();
			return true;
		}
		
	}
}
