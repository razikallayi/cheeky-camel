<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Console;

class Console_category extends Model
{
	protected $fillable = ['category','slug','created_at'];


	public function consoles()
	{
		
		return $this->hasMany('App\Models\Console','category_id','id')->get();
	}

	public static function saveData($request)
	{
		$cats = new Console_category;
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category);
		$cats->save();
		return true;
	}

    // get the data 

	public static function getCategory($id =null)
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


	// update the data 

	public static function updateCategory($request)
	{
		$cats = Console_category::findOrFail($request->id);
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category);
		$cats->save();
		return true;
	}

	// delete category

	public static function deleteCategory($id)
	{
		$items = Console::where('category_id',$id)->get();
		if(!$items->isEmpty())
		{
			return false;
		}
		else
		{
			$cats = self::findOrFail($id);
			$cats->delete();
			return true;
		}
		
	}

}
