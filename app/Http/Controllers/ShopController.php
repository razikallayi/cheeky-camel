<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop_category;
use App\Models\Shop;
use App\Models\ShopImage;
use App\Http\Requests;
use Image;
use File;
use Validator;

class ShopController extends Controller
{
    // index page

	public function index()
	{
		$cats = Shop_category::getCategory();
		return view('admin.shop.add-shop',['category' => $cats]);
	}

    // upload image 

	public function upload(Request $request)
	{
		
		$uploadImage=$request->image;
		$location=$request->location;
		if($location==null || $uploadImage==null){
			return;
		}
		$location = rtrim($location, '/');
		$filename=str_random(15).time().".png";
		ini_set('memory_limit', '-1');
		$image = Image::make($uploadImage,'png');

      // prevent possible upsizing
		$image->resize(270, 350, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		});

		if(!File::exists($location)) {
			File::makeDirectory($location);
		}
		$image->save($location."/".$filename);
		return response()->json([
			'filename' => $filename,
			'location' => str_finish($location, '/'),
			'src'      => url($location."/".$filename)
			]);
	}



   // store image

	public function store(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'category' => 'required',
			'productname' => 'required|max:60',
			'description' => 'required|max:50000',
			'quantity' => 'required',
			'price' => 'required',
			'discount' => 'required|min:0|max:100',
		
			'image' => 'required|array',
			])->validate();

		$shop = new Shop();
        // dd($request);
		$shop->saveShop($request);
		return back();
	}

	// manage shops

	public function manageShop()
	{
		$shops = Shop::getShops();
		return view('admin.shop.manage-shop',['shops' => $shops]);
	}


	// edit the data

	public function edit($id=null)
	{
		$cats = Shop_category::getCategory();
		$shops = Shop::getShops($id);
		return view('admin.shop.edit-shop',['shops' => $shops , 'category' => $cats]);
	}

	// update shops

	public function update(Request $request)
	{

		$this->validate($request,[
			'category' => 'required',
			'productname' => 'required|max:60',
			'description' => 'required|max:50000',
			'quantity' => 'required',
			'price' => 'required',
			'discount' => 'required|min:0|max:100',
			
			]);
		$shop = new Shop();
		$shop->updateShops($request);
		return back();
	}

	// delete dataa 

	public function deletes($id)
	{
		$shop = Shop::deleteData($id);
		return back();
	}


	// delete using ajax

	public function deleteImage(Request $request)
	{
		$this->validate($request, [
			'filename' => 'required',
			'location' => 'required',
			]);
		$location = str_finish($request->location, '/');
		$filename = $request->filename;
		$imageid = ShopImage::where('images',$filename)->first(['id']);
		if($imageid !=null){
			$imageid->delete();
		}
		if(file_exists($location.$filename)){
			unlink($location.$filename);
		}
		return response()->json(['status'=>'success']);

	} 


}
