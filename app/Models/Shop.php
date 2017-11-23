<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;
use DB;
use App\Models\ShopImage;

class Shop extends Model
{
	const TABLE = "shops";

	protected $fillable = ['category_id','title','description','quantity','price','discount','new_product','theme','mechanic','minimum_age','minimum_players','playing_time','publisher','slug'];

// getting category  of category-id

	public function category()
	{

		return $this->hasone('App\Models\Shop_category','id','category_id');
	}


	// get images of category id 


	public function images()
	{
		return $this->hasmany('App\Models\ShopImage','shop_id');
	}



	public function saveShop($request)
	{
		$shop = new Shop();
		$shop->category_id=$request->category;
		$shop->title=$request->productname;

		$shop->description=$request->description;
		$shop->quantity=$request->quantity;
		$shop->price=$request->price;
		$shop->discount=$request->discount;
		if(isset($request->newitem))
		{
			$shop->new_product = "1";
		}
		else
		{
			$shop->new_product = "0";
		}
		
		$shop->theme = $request->theme;
		$shop->mechanic=$request->mechanic;
		$shop->minimum_age = $request->minage;
		$shop->minimum_players = $request->players;
		$shop->playing_time = $request->time;
		$shop->publisher = $request->publisher;

		$shop->slug=str_slug($request->productname);
		
		$shop->save();
		$productname = $request->productname;
		foreach ($request->image as $image) {
			$shopimage = new ShopImage();
			$shopimage->saveShopImages($shop->id,$shop->title,$image);
		}

		return true;

	}


	// getting data 

	public static function getShops($id=null)
	{
		if($id== null)
		{
			return self::distinct()->get();
		}
		else
		{
			return self::findOrFail($id);
		}
	}


	// update shops

	public function updateShops($request)
	{

		// $shop = new Shop;
		$shop = Shop::findOrFail($request->id);

		$shop->category_id =$request->category;
		$shop->title = $request->productname;
		$shop->description = $request->description;
		$shop->quantity=$request->quantity;
		$shop->price = $request->price;
		$shop->discount = $request->discount;
		if(isset($request->newitem))
		{
			$shop->new_product = "1";
		}
		else
		{
			$shop->new_product = "0";
		}
		$shop->slug=str_slug($request->productname);

		$shop->theme = $request->theme;
		$shop->mechanic=$request->mechanic;
		$shop->minimum_age = $request->minage;
		$shop->minimum_players = $request->players;
		$shop->playing_time = $request->time;
		$shop->publisher = $request->publisher;
		

		$shop->save();

		// data from view

		$shop_id= $request->id;
		$item_name = $request->productname;

		if(isset($request->image))
		{

			foreach($request->image as $image)
			{
				$shopimage = new ShopImage;
				$shopimage->saveShopImages($shop_id,$item_name,$image);
			}
		}

		


	}


	// delete data 

	public static function deleteData($id)
	{

		$shop = self::findOrFail($id);
		
		$shopimage = ShopImage::where('shop_id',$id)->get();
		
		if(!is_null($shopimage))
		{
			
			foreach($shopimage as $image)
			{
				// dd($image);
				$myfile = ShopImage::IMAGE_LOCATION.'/'.$image->images;


				if(File::exists($myfile))
				{
					unlink($myfile);
					
				}
				DB::table('shop_images')->where('shop_id', '=', $id)->delete();

			}

			
		}

		$shop->delete();
		
		return true;
		
	}


	// retrieve data by using slug 

	public static function tableBySlug($slug=null)
	{
		if($slug==null)
		{
			return self::get();
		}
		else
		{
			return self::where('slug',$slug)->first();
		}
		
	}

	
	// getting the latest products 


	public static function getLatestShop()
	{
		return self::where('new_product','1')->get();
	}


	// update cart 

	public static function updateCart($category,$item)
	{
		$shop = Self::findOrFail($item);
		$shop->cart_item_category = $category ;
		$shop->cart_list = "1";
		$shop->save();
		return true;


	}



	// #################### shop    #######################//

	public static function getShopByDistinctCategory($id = null)
	{


		$shops = self::select('category_id')->distinct()->get();
		if(!$shops->isEmpty())
		{
			foreach($shops as $shop)
			{
				$shopss[] = self::where('category_id',$shop->category_id)->first();
			}

			return $shopss;
		}
	}


	// ########################### theme filters ################################ //


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


	// ############################################################### //

	public static function tabletopsFilters($request)
	{
		
		
		//$query = DB::table('shops');
		$query = self::query();
		if($request->has('range1') && $request->has('range2') )
		{
			$query->whereBetween('price',  array($request->range1, $request->range2));
			
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
		//$result =Shop::hydrate($query->get()->toArray());
		return $result ;

	}


	public static function getShopBySlug($slug)
	{
		return;
		// $rs =self::where('')category()->category;
	}





	
}
