<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Apparel;

class Apparel_category extends Model
{
   //
	protected $fillable = ['category','slug'];

	public function apparels()
	{

		return $this->hasMany('App\Models\Apparel','category_id','id')->get();
	}

	public static function saveData($request)
	{
		$cats = new Apparel_category;
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category);
		$cats->save();
		return true;
	}

	// getting data 

	public static function getCategory($id=null)
	{
		if($id==null)
		{
			return self::get();
		}
		else
		{
			return self::findOrFail($id);
		}

	}


	// update data 

	public function updateCategory($request)
	{
		$cats = Apparel_category::findOrFail($request->id);
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category);
		$cats->save();
		return true;
	}

	// delete 

	public function deleteCategory($id)
	{
		$items = Apparel::where('category_id',$id)->get();
		if(!$items->isEmpty())
		{
			return false;
		}
		else
		{
			$cats = Apparel_category::findOrFail($id);
			$cats->delete();
			return true;
		}
	}
}
