<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gift_category;
use App\Models\Gift;
//use App\Models\ShopImage;
use App\Http\Requests;
use Image;
use File;
use Validator;

class GiftController extends Controller
{
    //
    public function index()
    {
      $cats = Gift_category::getCategory();
      return view('admin.gifts.add-gift',['category' => $cats]);
  }


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
                  // prevent possible upsizing // 445 , 643
    $image->resize(445,643, function ($constraint) {
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




public function store(Request $request)
{
       //Validatie
   $validator = Validator::make($request->all(), [
      'category' => 'required',
      'title' => 'required',
      'image' => 'required',
      ]);
   if ($validator->fails()) {
      if($request->has('image')){
         foreach ($request->image as $image) {
            $location = str_finish(Gift::IMAGE_LOCATION, '/');
            $filename = $image;
            unlink($location.$filename);
        }
        $validator->getMessageBag()->add('image_lost', 'Sorry we have lost your images. Please upload the image(s) again');
    }
    return redirect()->back()
    ->withErrors($validator)
    ->withInput();
}

$gift = new Gift();

$gift->saveGifts($request);
return back();
}


public function manage()
{
   $gifts = Gift::getGifts();
   return view('admin.gifts.manage-gift',['gifts'=>$gifts]);
}

public function edit($id=null)
{
   $cats = Gift_category::getCategory();

   $gifts = Gift::getGifts($id);
   return view('admin.gifts.edit-gift',['gift'=>$gifts , 'category' => $cats]);
}


public function update(Request $request)
{
        // //Validatie
    $validator = Validator::make($request->all(), [
        'category' => 'required',
        'title' => 'required',

        ]);

    if ($validator->fails()) {
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $gift = new Gift();
    $gift->updateGift($request);
    return back();
}



public  function delete($id)
{
    $gift = Gift::deleteGifts($id);
    return back();
}



}
