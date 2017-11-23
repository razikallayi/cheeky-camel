<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopImage extends Model
{

	const IMAGE_LOCATION = "uploads/shops";
    
    protected $fillable = ['shop_id','name','images'];

// images using joins 

    // public function shop()
    // {
    // 	return $this->belongsTo('App\Models\Shop')->get();
    // }

//
    public function saveShopImages($shopId,$shopname,$image){

        $ShopImage = new ShopImage();
 		$ShopImage->shop_id=$shopId;
		$ShopImage->name=$shopname;
		$ShopImage->images=$image;
	    return $ShopImage->save();
		
    }


    // 


}
