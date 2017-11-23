<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Console_image;
use DB;
use File;

class Console extends Model
{

  const TABLE = "consoles";

  protected $fillable = ['category_id','title','description','price','discount','quantity','new_product','theme','mechanic','minimum_age','minimum_players','playing_time','publisher','slug','created_at'];


  public function category()
  {
   return $this->hasOne('App\Models\Console_category','id','category_id');
 }

 public function images()
 {
   return $this->hasmany('App\Models\Console_image','console_id');

	//$this->hasmany('App\Models\Console_image','console_id')->toSql();

 }

 


    // index 

 public function saveConsole($request)
 {
   $con = new Console;
   $con->category_id = $request->category ;
   $con->title = $request->itemname;
   $con->description =$request->description;
   $con->price = $request->price;
   $con->discount = $request->discount;
   $con->quantity = $request->quantity;
   if(isset($request->newitem))
   {

    $con->new_product = "1";

  }
  else
  {

    $con->new_product = "0";

  }
  $con->slug = str_slug($request->itemname);

    $con->theme = $request->theme;
    $con->mechanic=$request->mechanic;
    $con->minimum_age = $request->minage;
    $con->minimum_players = $request->players;
    $con->playing_time = $request->time;
    $con->publisher = $request->publisher;


  $con->save();

  if(isset($request->image))
  {
    $id = $con->id;
    $name = $request->title;
    foreach($request->image as $image)
    {
     $cimage = new Console_image;
     $cimage->saveImages($image, $id,$name);
   }
 }
    	//return true;
}

    // get data

public static function getConsole($id=null)
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


    // update console 

public function updateConsole($request)
{


  $con = Console::findOrFail($request->id);
  $con->category_id = $request->category ;
  $con->title = $request->itemname;
  $con->description =$request->description;
  $con->price = $request->price;
  $con->discount = $request->discount;
  $con->quantity = $request->quantity;
   if(isset($request->newitem))
   {

    $con->new_product = "1";

  }
  else
  {

    $con->new_product = "0";
    
  }
  $con->slug = str_slug($request->itemname);

    $con->theme = $request->theme;
    $con->mechanic=$request->mechanic;
    $con->minimum_age = $request->minage;
    $con->minimum_players = $request->players;
    $con->playing_time = $request->time;
    $con->publisher = $request->publisher;

  $con->save();
 // dd($request->all());
  if(isset($request->image))
  {
    $id = $con->id;
    $name = $request->itemname;
    foreach($request->image as $image)
    {

      $cimage = new Console_image;
      $cimage->saveImages($image, $id,$name);
    }
  }
}


// delete consoles

public function deleteConsole($id)
{

  $console = self::findOrFail($id);
  $consoleimage = Console_image::where('console_id',$id)->get();

  if(!is_null($consoleimage))
  {
    foreach($consoleimage as $image)
    {
      $myfile = Console_image::IMAGE_LOCATION.'/'.$image->images;


      if(File::exists($myfile))
      {
        unlink($myfile);

      }
      DB::table('console_images')->where('console_id', '=', $id)->delete();
    }
  }

  $console->delete();
  return true;
}


// get the consloe by slug

public static function getConsoleBYSlug($slug=null)
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

// ######################################################


public static function getConsoleByDistinctCategory($id = null)
{


  $consoles = self::select('category_id')->distinct()->get();
  if(!$consoles->isEmpty())
  {
    foreach($consoles as $console)
    {
      $consoless[] = self::where('category_id',$console->category_id)->first();
    }
    
    return $consoless;
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

  // ------------------------ filters here ---------------------------- //



  public static function consoleFilters($request)
  {
   
    $query = self::query();

    if($request->has('range1') && $request->has('range2'))
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
   // $result =Console::hydrate($query->get()->toArray());
    return $result ;

  }

}
