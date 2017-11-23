<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Console;
use App\Models\Console_category;
use App\Models\Console_image;
use Validator;
use Image;
use File;

class ConsoleController extends Controller
{
    // index page 

	public function index()
	{
		$cats = Console_category::getCategory();
		return view('admin.console.add-console',['category' => $cats]);
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

		$console = new Console();

		$console->saveConsole($request);
		return back();
	}

	// manage 

	public function manage()
	{
		$cats = Console_category::getCategory();
		$consoles = Console::getConsole();
		return view('admin.console.manage-console',['consoles' => $consoles ,'category' =>$cats]  );
	}

	// eddit the page

	public function Console_edit($id = null)
	{

		$category = Console_category::getCategory();
		
		$consoles = Console::getConsole($id);
		
		return view('admin.console.edit-console',['category' => $category , 'console' => $consoles]);
	}

	// update

	public function update(Request $request)
	{
		
		$this->validate($request,[
			'category' => 'required',
			'itemname' => 'required|max:60',
			'description' => 'required|max:50000',
			'quantity' => 'required',
			'price' => 'required',
			'discount' => 'required|min:0|max:100',
			]);

		$console = new Console();
// dd($request->all());
		$console->updateConsole($request);
		return back();

	}

	// delete console 

	public function deletes($id)
	{
		$console = new Console;
		$console->deleteConsole($id);
		return back();
	}

	// ajax delete

	public function deleteImage(Request $request)
	{

		$this->validate($request, [
			'filename' => 'required',
			'location' => 'required',
			]);
		$location = str_finish($request->location, '/');
		$filename = $request->filename;
		$imageid = Console_image::where('images',$filename)->first(['id']);
		if($imageid !=null){
			$imageid->delete();
		}
		if(file_exists($location.$filename)){
			unlink($location.$filename);
		}
		return response()->json(['status'=>'success']);

	} 


}
