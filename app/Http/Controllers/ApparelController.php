<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Apparel;
use App\Models\Apparel_category;
use App\Models\Apparel_image;
use App\Http\Requests;
use Image;
use File;

class ApparelController extends Controller
{
    // index page
	public function index()
	{
		$category = Apparel_category::getCategory();
		return view('admin.apparels.add-apparels',['category' => $category]);

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
			'itemname' => 'required|max:60',
			'description' => 'required|max:50000',
			'quantity' => 'required',
			'price' => 'required',
			'discount' => 'required|min:0|max:100',
			'image' => 'required|array',
			])->validate();

		$apparel = new Apparel();

		$apparel->saveApparel($request);
		return back();
	}


	// manage 

	public function manage()
	{
		$items = Apparel::getApparels();
		return view('admin.apparels.manage',['items' => $items]);
	}

	// edit data 

	public function edit($id=null)
	{
		$items = Apparel::getApparels($id);
		$category = Apparel_category::getCategory();
		return view('admin.apparels.edit-apparel',['items' => $items , 'category' => $category]);
	}

	// update 

	public function update(Request $request)
	{

		$this->validate($request,[
			'category' => 'required',
			'itemname' => 'required|max:60',
			'description' => 'required|max:50000',
			'quantity'=>'required',
			'price' => 'required',
			'discount' => 'required|min:0|max:100',
			
			]);
		$apparel = new Apparel();
		$apparel->updateApparel($request);
		return back();
	}

	// delete 

	public function deletes($id)
	{
	$apparel = new Apparel;
	$apparel->deleteApparel($id);
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
		$imageid = Apparel_image::where('images',$filename)->first(['id']);
		if($imageid !=null){
			$imageid->delete();
		}
		if(file_exists($location.$filename)){
			unlink($location.$filename);
		}
		return response()->json(['status'=>'success']);

	} 





}
