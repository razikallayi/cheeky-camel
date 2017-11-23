<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Brand;
use Image;
use File;
use Validator;

class BrandController extends Controller
{
    // index page

	public function index()
	{
		return view('admin.brands.add-brands');
	}

    // upload image


	// public function upload_image(Request $request)
	// {

	// 	$uploadImage=$request->image;
	// 	$location=$request->location;
	// 	if($location==null || $uploadImage==null){
	// 		return;
	// 	}
	// 	$location = rtrim($location, '/');
	// 	$filename=str_random(15).time().".png";
	// 	ini_set('memory_limit', '-1');
	// 	$image = Image::make($uploadImage,'png');

 //      // prevent possible upsizing
	// 	$image->resize(1920, null, function ($constraint) {
	// 		$constraint->aspectRatio();
	// 		$constraint->upsize();
	// 	});

	// 	if(!File::exists($location)) {
	// 		File::makeDirectory($location);
	// 	}
	// 	$image->save($location."/".$filename);
	// 	return response()->json([
	// 		'filename' => $filename,
	// 		'location' => str_finish($location, '/'),
	// 		'src'      => url($location."/".$filename)
	// 		]);

	// }



  public function upload_image(Request $request){

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
    $image->resize(142, 134, function ($constraint) {
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

       //Validatie
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'description' => 'required',
			'image' => 'required',
			
			]);
		if ($validator->fails()) {
			if($request->has('image')){
				foreach ($request->image as $image) {
					$location = str_finish(Brand::IMAGE_LOCATION, '/');
					$filename = $image;
					unlink($location.$filename);
				}
				$validator->getMessageBag()->add('image_lost', 'Sorry we have lost your images. Please upload the image(s) again');
			}
			return redirect()->back()
			->withErrors($validator)
			->withInput();
		}

		$brand = new Brand();
        // dd($request);
		$brand->saveBrand($request);
		return back();
	}


	// delete image 

	public function deleteImage(Request $request)
	{

		$this->validate($request, [
			'filename' => 'required',
			'location' => 'required',
			]);
		$location = str_finish($request->location, '/');
		$filename = $request->filename;

		if($location.$filename)
		{
			unlink($location.$filename);
		}
		
		return response()->json(['status'=>'success']);
	}


	// manage brand

	public function manageBrand()
	{
		$result = Brand::getBrands();
		return view('admin.brands.manage-brands',['brands' => $result]);
	}

	// edit brands 

	public function editBrand($id=null)
	{
		$result = Brand::getBrands($id);
		return view('admin.brands.edit-brands',['brands' => $result]);
	}

	// update brands 

	public function updateBrands(Request $request)
	{
		$this->validate($request,[
			'title' => 'required',
			'description' => 'required',
			]);
		$brands = new Brand;
		$brands->updateBrand($request);
		return back();
	}

	// delete brands 

	public function deleteBrands($id)
	{
		$brand = new Brand;
		$brand->deleteBrand($id);
		return back();
	}
}
