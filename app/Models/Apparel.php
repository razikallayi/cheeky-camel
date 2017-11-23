<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Apparel_image;
use File;
use DB;
class Apparel extends Model
{
	const TABLE = "apparels" ;

	protected $fillable =['category_id','title','description','price','discount','quantity','new_product','theme','mechanic','minimum_age','minimum_players','playing_time','publisher','slug','created_at'];


// get the category 

	public function category()
	{
		return $this->hasOne('App\Models\Apparel_category','id','category_id')->get();
	}


	// image using joins

	public function images()
	{
		return $this->hasMany('App\Models\Apparel_image','apparel_id');
	}

    // save 

	public function saveApparel($request)
	{
		$apparel = new Apparel;
		$apparel->category_id = $request->category;
		$apparel->title = $request->itemname;
		$apparel->description = $request->description;
		$apparel->quantity = $request->quantity;
		$apparel->price = $request->price;
		$apparel->discount = $request->discount;
		if(isset($request->newitem))
		{
			$apparel->new_product = "1";
		}
		else
		{
			$apparel->new_product = "0";
		}
		$apparel->slug = str_slug($request->itemname);

		$apparel->theme = $request->theme;
		$apparel->mechanic=$request->mechanic;
		$apparel->minimum_age = $request->minage;
		$apparel->minimum_players = $request->players;
		$apparel->playing_time = $request->time;
		$apparel->publisher = $request->publisher;

		$apparel->save();

		if(isset($request->image))
		{
			$id = $apparel->id;
			$name= $request->itemname;

			foreach($request->image as $image)
			{
				$apparelimage = new Apparel_image;
				$apparelimage->saveData($image , $id , $name );
			}
		}
		return true;
	}

	// gett data 

	public static function getApparels($id=null)
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


	// update data

	public function updateApparel($request)
	{

		$apparel =  Apparel::findOrFail($request->id);
		$apparel->category_id = $request->category;
		$apparel->title = $request->itemname;
		$apparel->description = $request->description;
		$apparel->quantity = $request->quantity;
		$apparel->price = $request->price;
		$apparel->discount = $request->discount;
		if(isset($request->newitem))
		{
			$apparel->new_product = "1";
		}
		else
		{
			$apparel->new_product = "0";
		}
		$apparel->slug = str_slug($request->itemname);

		$apparel->theme = $request->theme;
		$apparel->mechanic=$request->mechanic;
		$apparel->minimum_age = $request->minage;
		$apparel->minimum_players = $request->players;
		$apparel->playing_time = $request->time;
		$apparel->publisher = $request->publisher;

		$apparel->save();
		

		if(isset($request->image))
		{
			$id = $apparel->id;
			$name= $request->itemname;

			foreach($request->image as $image)
			{
				$apparelimage = new Apparel_image;
				$apparelimage->saveData($image , $id , $name );
			}
		}
		return true;
	}

	// delete data

	public function deleteApparel($id)
	{
		$apparel = self::findOrFail($id);
		$apparelimage = Apparel_image::where('apparel_id',$id)->get();
		
		if(!is_null($apparelimage))
		{
			foreach($apparelimage as $image)
			{
				$myfile = Apparel_image::IMAGE_LOCATION.'/'.$image->images;


				if(File::exists($myfile))
				{
					unlink($myfile);
					
				}
				DB::table('apparel_images')->where('apparel_id', '=', $id)->delete();
			}
		}

		$apparel->delete();
		return true;
		
	}


	// apparel using slug 

	public static function getApparelBySlug($slug)
	{
		if($slug == "" || $slug==null)
		{
			return self::get();
		}
		else
		{
			return self::where('slug',$slug)->first();
		}
	}


	// disticnct cats

	public static function getApparelsByDistinctCategory($id = null)
	{


		$apparels = self::select('category_id')->distinct()->get();
		if(!$apparels->isEmpty())
		{
			foreach($apparels as $apparel)
			{
			// dd($apparel);
				$apprls[] = self::where('category_id',$apparel->category_id)->first();

			}
			return $apprls;
		}

		
	}


	public  static function themes()
	{
		return self::distinct()->get(['theme']);
	} 

	public  static function mechanic()
	{
		return self::distinct()->get(['mechanic']);
	} 

	public  static function types()
	{
		return self::distinct()->get(['category_id']);
	} 

	public  static function ages()
	{
		return self::distinct()->get(['minimum_age']);
	} 

	public  static function players()
	{
		return self::distinct()->get(['minimum_players']);
	}

	public  static function times()
	{
		return self::distinct()->get(['playing_time']);
	} 

	public  static function publisher()
	{
		return self::distinct()->get(['publisher']);
	}


// filters start here 





	public static function apparelFilters($request)
	{
		
		$query = self::query();

		if($request->has('range1') && $request->has('range2'))
		{
		
		$query->whereBetween('price', array($request->range1 , $request->range2) );
				
		}
		if($request->has('theme'))
		{
			
			$query->where('theme','LIKE',$request->theme);
		}
		if($request->has('mechanic'))
		{
			$query->where('mechanic','LIKE',$request->mechanic);
		}
		if($request->has('category'))
		{
			$query->where('category_id','LIKE',$request->category);
		}
		if($request->has('minage'))
		{
			$query->where('minimum_age','LIKE',$request->minage);
		}
		if($request->has('players'))
		{
			$query->where('minimum_players','LIKE',$request->players);
		}
		if($request->has('time'))
		{
			$query->where('playing_time','LIKE',$request->time);
		}
		if($request->has('publisher'))
		{
			$query->where('publisher','LIKE',$request->publisher);
		}

		$result = $query->with('images')->get();


		//$result =Apparel::hydrate($query->get()->toArray());
		return $result ;

	}
}
