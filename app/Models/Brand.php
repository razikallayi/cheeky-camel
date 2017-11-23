<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const IMAGE_LOCATION="uploads/brands";
    protected $fillable = ['title','description','logo','slug','created_at','updated_at'];
    
    public function saveBrand($request)
    {

    	$brand = new Brand;
    	$brand->title = $request->title;
    	$brand->description = $request->description;
    	
    	$brand->slug = str_slug($request->title);
     if(isset($request->image))
     {
        $brand->logo = $request->image[0];
    }

    $brand->save();
    return true;
}

    // getting brands 

public static function getBrands($id=null)
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


    // brands update

public function updateBrand($request)
{
    // dd($request->all()); 
    $brand = Brand::findOrFail($request->id);
    $brand->title = $request->title;
    $brand->description = $request->description;

    $brand->slug = str_slug($request->title);

    // if(isset($request->image))
    // {
    //     $brand->logo = $request->image[0];
    // }

    if(isset($request->image))
    {
        if(!is_null($brand->logo)){
            if(file_exists(self::IMAGE_LOCATION.$brand->logo)){
                unlink(self::IMAGE_LOCATION.$brand->logo);
            }
        }

        if(is_array($request->image)){
            $brand->logo = $request->image[0];
        }else{
            $brand->logo = $request->image;
        }

    }
    $brand->save();
    return true;
}


// delete brands 

public function deleteBrand($id)
{
    $brand = Brand::findOrFail($id);
    $brand->delete();
    return true;
}


}
