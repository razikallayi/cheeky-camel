<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Shop_category extends Model
{

	protected $fillable = ['category','slug'];

    //save


	public  function shops()
	{
		//dd("Dgdf");
		return $this->hasMany('App\Models\Shop','category_id','id')->get() ;
	}

	public function saveCategory($request)
	{
		$cats = new Shop_category;
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category);
		$cats->save();
		return true;
	}

    // get data 

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

	// update category 

	public static function updateCategory($request)
	{
		$cats = Shop_category::findOrFail($request->id);
		$cats->category = $request->category;
		$cats->slug = str_slug($request->category) ;
		$cats->save();
		return true;
	}

	// delete category

	public static function deleteCategory($id)
	{

		$item = Shop::where('category_id',$id)->get();
		
		if(!$item->isEmpty())
		{

			return false;
		}
		else
		{

			$cats = Shop_category::findOrFail($id);
			$cats->delete();
			return true;
		}
		
	}



}
