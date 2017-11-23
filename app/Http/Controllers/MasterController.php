<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\Register;
use App\Models\Shop;
use App\Models\Shop_category;
use App\Models\Apparel;
use App\Models\Console;
use App\Models\Brand;
use App\Models\Gift;
use App\Models\Console_category;
use App\Models\Apparel_category;
use App\Models\cartmodel;
//use App\Models\Event;
use App\Mail\ReplyMail;
use App\Mail\OrderCheckout;
use Mail;
use Input;
use Cart;
use Session;
use Newsletter;
use DB;
use Redirect;

use App\Models\Event as CalendarEvent;
use Calendar;

class MasterController extends Controller
{

    const NOT_EXISTING = "not_existing";
    // index page 

    public function index()
    {

        $brands = Brand::getBrands();
        $latest_items = Shop::getLatestShop(); 
        $gifts = Gift::orderBy('id','DESC')->get()->take(3);


        $tabletops = Shop::getShops()->take(5);

        return view('cheekycamel.home.index',['brands' => $brands , 'items' => $latest_items ,'gifts' => $gifts ,'tabletops' => $tabletops ]);
    }

    // about us page 

    public function about_us()
    {
    	return view('cheekycamel.about-us.aboutus');
    }

    // tabletops here 


    public function tabletop()
    {

        $shops = Shop::getShopByDistinctCategory();

        

        $tabletops = Shop::getShops(); 
        $themes = Shop::themes();
        $mechanics = Shop::mechanic();
        $types = Shop::types();
        $ages = Shop::ages();
        $players = Shop::players();
        $times = Shop::times();
        $publishers = Shop::publisher();
        return view('cheekycamel.collectibles.collectibles',['tabletops'=> $tabletops ,'shops'=>$shops ,'themes' => $themes ,'mechanics' => $mechanics ,'types' => $types ,'ages' => $ages ,'players' => $players ,'times' => $times ,'publishers'=>$publishers]);
    }


    // details of table tops here 

    public function details($slug=null)
    {


         $single = Shop::tableBySlug($slug); // single data by using slug here
        //$single = Shop::where('slug',$slug)->get();
// dd($single);
        $cartId = $single->id ."-". 'shops';
        $carts = Cart::get($cartId);

        return view('cheekycamel.collectibles.details',['items' => $single ,'carts'=>$carts]);
    }


    // apparels 

    public function apparels()
    {
        $app_categorys = Apparel::getApparelsByDistinctCategory(); // all apparels here
        $apparels = Apparel::getApparels();
        $themes = Apparel::themes();

        $mechanics = Apparel::mechanic();

        $types = Apparel::types();

        $ages = Apparel::ages();

        $players = Apparel::players();

        $times = Apparel::times();

        $publishers = Apparel::publisher();

        return view('cheekycamel.apparels.apparels',['apparels' => $apparels ,'apps' => $app_categorys ,'themes' => $themes ,'mechanics' => $mechanics ,
            'types' => $types ,'players' => $players ,'times' => $times ,'publishers'=>$publishers , 'ages' => $ages ]);
    }


    // apparel details 

    public function apparel_details($slug=null)
    {

        $single_apparel = Apparel::getApparelBySlug($slug);
        $cartId = $single_apparel->id ."-". 'apparels';
        $carts = Cart::get($cartId);
        return view('cheekycamel.apparels.details',['apparels' => $single_apparel ,'carts' => $carts]);
    }

    // gift 

    public function gift()
    {
        $giftboxes = Gift::getGifts();
        return view('cheekycamel.gift.gift' ,['giftboxes' => $giftboxes]);
    }

    // our brands

    public function brands()
    {
        $brands = Brand::getBrands();
        return view('cheekycamel.brands.our-brand',['brands' => $brands]);
    }

    // contact us

    public function contact_us()
    {
    	return view('cheekycamel.contact-us.contact');
    }

    // CONSOLE 

    public function console()
    {
        $consoles = Console::getConsole();
        $cons = Console::getConsoleByDistinctCategory();
        $themes = Console::themes();
        $mechanics = Console::mechanic();
        $types = Console::types();
        $ages = Console::ages();
        $players = Console::players();
        $times = Console::times();
        $publishers = Console::publisher();
        return view('cheekycamel.console.console',['consoles' => $consoles ,'cons' => $cons ,'themes' => $themes ,'mechanics' => $mechanics ,'types' => $types ,'ages' => $ages ,'players' => $players ,'times' => $times ,'publishers'=>$publishers]);
    }

    // details of console

    public function console_details($slug=null)
    {

        $single_console = Console::getConsoleBYSlug($slug);
        $cartId = $single_console->id ."-". 'consoles';
        $carts = Cart::get($cartId);
        return view('cheekycamel.console.details',['consoles' => $single_console ,'carts'=> $carts]);
    }

    // cart details 


    public function cart()
    {

        $cart= Cart::getContent();

        return view('cheekycamel.cart.cart',[ 'carts' => $cart ]);
    }


    public function add_to_Cart(Request $request)
    {


     $shop = Shop::find($request->id);

     $quantity = $request->currentVal?$request->currentVal:self::NOT_EXISTING;

     $cartArray = [
     'cartId' => $shop->id."-"."shops",
     'name' => $shop->title,
     'price' => ($shop->price - ceil(($shop->discount/100) * $shop->price)),
     'quantity' => $quantity,
     'stock' => $shop->quantity,
     'image' => $shop->images()->first()->images ,
     'description' => $shop->description,
     'discount' => $shop->discount, 
     'table' => 'shops',
     'itemId' =>$shop->id,
     'categoryId' =>$shop->category_id,
     ];

     return $this->addToCart( $cartArray);

 }



 public function addToCart($cartArray)
 {

//$cartId,$name,$price,$quantity,$attributes,$image,$description,$discount,$table,$itemId,$categoryId

    $existingQuantity=0;
    if(Cart::has($cartArray['cartId'])){

        $existingQuantity = Cart::get($cartArray['cartId'])->quantity;
        Cart::remove($cartArray['cartId']);
    }

    if($cartArray['quantity']==self::NOT_EXISTING)
    {
        $cartArray['quantity'] = $existingQuantity+1;
    }


    Cart::add([
        'id' => $cartArray['cartId'],
        'name' => $cartArray['name'],
        'price' => $cartArray['price'],
        'quantity' => $cartArray['quantity'],

        'attributes' => [
        'stock' => $cartArray['stock'],
        'image' => $cartArray['image'] ,
        'description' => $cartArray['description'],
        'discount' => $cartArray['discount'], 
        'table' => $cartArray['table'] ,
        ]
        ]);


    $userId= Session::get('user_id');
         if($userId) // authenticated user , then store cart to db..
         {
             $this->saveCartToDatabase($userId,$cartArray['itemId'],$cartArray['categoryId']);
         }

         return $this->sendJsonResponse($cartArray);
     }


// remove data from cart here 

     public function saveCartToDatabase($id,$itemId,$categoryId)
     {
        //TODO:updateCart
       $userdata = [
       'userid' => $id,
       'itemid' => $itemId,
       'category' => $categoryId,
       ];

       cartmodel::saveData($userdata);
   }

   public function sendJsonResponse($cartArray)
   {


     return response()->json([
        "status" => "success",
        'cartId' => $cartArray['cartId'],
        'title'=>$cartArray['name'],
        'description' => $cartArray['description'],
        'price' => $cartArray['price'],
        'quantity' => $cartArray['quantity'],
        'stock' => $cartArray['stock'],
        'cartTotalprice' => Cart::getTotal() ,
        'cartCount' => Cart::getContent()->count()
        ]);
 }


// remove data from cart here 
 public function removeCart(Request $request)
 {
    if(Session::get('user_id'))
    {
        $userid = Session::get('user_id');
        $cart = cartmodel::where('userid',$userid);
    }

    $this->validate($request, [
       'id' => 'required',
       ]);
    Cart::remove($request->id);
    return response()->json(["status"=>"success",
       'cartTotalPrice'=>Cart::getTotal(),
       'cartCount' => Cart::getContent()->count()]);
}


// update cart here 

public function updateCart(Request $request){
 $this->validate($request, [
   'id' => 'required',
   ]);

 if(Cart::has($request->id)){
    $cart = Cart::get($request->id);
    Cart::remove($request->id);
    $itemId=explode("-", $request->id)[0];
    //

    $cartArray = [
    'cartId' => $request->id,
    'quantity' => $request->quantity?$request->quantity:1,
    ];

    switch ($cart->attributes->table) {
        case 'shops':
        $cartArray = $this->shopsToCart($itemId,$cartArray);
        break; 
        case 'consoles':
        $cartArray = $this->consolesToCart($itemId,$cartArray);
        break;
        case 'apparels':
        $cartArray = $this->apparelssToCart($itemId,$cartArray);
        break;
        default:
        break;
    }
}
$this->addToCart($cartArray);

return $this->sendJsonResponse($cartArray);
}



public function shopsToCart($id,$cartArray)
{
    $shop = Shop::find($id);
    return $cartArray = [
    'cartId' => $cartArray['cartId'],
    'quantity' => $cartArray['quantity'],
    'name' => $shop->title,
    'price' => ($shop->price - ceil(($shop->discount/100) * $shop->price)),
    'stock' => $shop->quantity,
    'image' => $shop->images()->first()->images ,
    'description' => $shop->description,
    'discount' => $shop->discount, 
    'table' => 'shops',
    'itemId' =>$shop->id,
    'categoryId' =>$shop->category_id,
    ];
}
public function consolesToCart($id,$cartArray)
{
    $console = Console::find($id);
    return $cartArray = [
    'cartId' => $cartArray['cartId'],
    'quantity' => $cartArray['quantity'],
    'name' => $console->title,
    'price' => ($console->price - ceil(($console->discount/100) * $console->price)),
    'stock' => $console->quantity,
    'image' => $console->images()->first()->images ,
    'description' => $console->description,
    'discount' => $console->discount, 
    'table' => 'consoles',
    'itemId' =>$console->id,
    'categoryId' =>$console->category_id,
    ];
}
public function apparelssToCart($id,$cartArray)
{
    $apparel = Apparel::find($id);
    return $cartArray = [
    'cartId' => $cartArray['cartId'],
    'quantity' => $cartArray['quantity'],
    'name' => $apparel->title,
    'price' => ($apparel->price - ceil(($apparel->discount/100) * $apparel->price)),
    'stock' => $apparel->quantity,
    'image' => $apparel->images()->first()->images ,
    'description' => $apparel->description,
    'discount' => $apparel->discount, 
    'table' => 'apparels',
    'itemId' =>$apparel->id,
    'categoryId' =>$apparel->category_id,
    ];
}


public function apparel_add_to_cart(Request $request)
{

    $apparel = Apparel::find($request->id);
    $quantity = $request->currentVal?$request->currentVal:self::NOT_EXISTING;

    $cartArray = [
    'cartId' => $apparel->id."-"."apparels",
    'name' => $apparel->title,
    'price' => ($apparel->price - ceil(($apparel->discount/100) * $apparel->price)),
    'quantity' => $quantity,
    'stock'=>$apparel->quantity,
    'image' => $apparel->images()->first()->images ,
    'description' => $apparel->description,
    'discount' => $apparel->discount,
    'table' => 'apparels', 
    'itemId' => $apparel->id,
    'categoryId' => $apparel->category_id,
    ];

    return $this->addToCart($cartArray);

}

public function console_add_to_cart(Request $request)
{
   $console = Console::find($request->id);
   $quantity = $request->currentVal?$request->currentVal:self::NOT_EXISTING;
   $cartArray = [
   'cartId' => $console->id."-"."consoles",
   'name' => $console->title,
   'price' => ($console->price - ceil(($console->discount/100) * $console->price)),
   'quantity' => $quantity,
   'stock'=>$console->quantity,
   'image' => $console->images()->first()->images ,
   'description' => $console->description,
   'discount' => $console->discount, 
   'table' => 'consoles',
   'itemId' => $console->id,
   'categoryId' => $console->category_id,
   ];

   return $this->addToCart($cartArray);
}


// ################################### filters here ############################# //

public function tabletopFilter(Request $request)
{
    $table = $request->table;
    if($table == "tabletop")
    {
        $top = Shop::tabletopsFilters($request);

        $shops = Shop::getShopByDistinctCategory();

        $themes = Shop::themes();
        $mechanics = Shop::mechanic();
        $types = Shop::types();
        $ages = Shop::ages();
        $players = Shop::players();
        $times = Shop::times();
        $publishers = Shop::publisher();
        return view('cheekycamel.collectibles.collectibles',['tabletops'=> $top ,'shops'=>$shops ,'themes' => $themes ,'mechanics' => $mechanics ,'types' => $types ,'ages' => $ages ,'players' => $players ,'times' => $times ,'publishers'=>$publishers]);

    }

    elseif($table == "apparel")
    {
         $app_categorys = Apparel::getApparelsByDistinctCategory(); // all apparels here
         $apparels = Apparel::apparelFilters($request);
         $themes = Apparel::themes();

         $mechanics = Apparel::mechanic();

         $types = Apparel::types();

         $ages = Apparel::ages();

         $players = Apparel::players();

         $times = Apparel::times();

         $publishers = Apparel::publisher();

         return view('cheekycamel.apparels.apparels',['apparels' => $apparels ,'apps' => $app_categorys ,'themes' => $themes ,'mechanics' => $mechanics ,
            'types' => $types ,'players' => $players ,'times' => $times ,'publishers'=>$publishers , 'ages' => $ages ]);
     }

     elseif($table == "console")
     {
        $consoles = Console::consoleFilters($request);
        $cons = Console::getConsoleByDistinctCategory();
        $themes = Console::themes();
        $mechanics = Console::mechanic();
        $types = Console::types();
        $ages = Console::ages();
        $players = Console::players();
        $times = Console::times();
        $publishers = Console::publisher();
        return view('cheekycamel.console.console',['consoles' => $consoles ,'cons' => $cons ,'themes' => $themes ,'mechanics' => $mechanics ,'types' => $types ,'ages' => $ages ,'players' => $players ,'times' => $times ,'publishers'=>$publishers]);
    }

}


public function tabletop_details($slug)
{
    $laterslug = str_replace('-',' ',$slug);

    $res = DB::table('shop_categories')
    ->join('shops','shops.category_id','=','shop_categories.id')
    ->where('shop_categories.slug','=',$slug)
    ->select('shop_categories.category')->first();
    
    if($res != null || $res != "")
    {
        $res_category = $res->category;
        $tabletops = Shop_category::where('category',$res_category)->first()->shops();
    }
    else
    {
        $tabletops = Shop_category::where('category',$laterslug)->first()->shops();
    }

    $shops = Shop::getShopByDistinctCategory();

    $themes = Shop::themes();
    $mechanics = Shop::mechanic();
    $types = Shop::types();
    $ages = Shop::ages();
    $players = Shop::players();
    $times = Shop::times();
    $publishers = Shop::publisher();
    return view('cheekycamel.collectibles.collectibles',['tabletops'=> $tabletops ,'shops'=>$shops ,'themes' => $themes ,'mechanics' => $mechanics ,'types' => $types ,'ages' => $ages ,'players' => $players ,'times' => $times ,'publishers'=>$publishers ]);
}


public function apparel_category($slug)
{

   $slug = str_replace('-',' ',$slug);

 $app_categorys = Apparel::getApparelsByDistinctCategory(); // all apparels here
 $apparels = Apparel_category::where('category',$slug)->first()->apparels(); 
 
 $themes = Apparel::themes();

 $mechanics = Apparel::mechanic();

 $types = Apparel::types();

 $ages = Apparel::ages();

 $players = Apparel::players();

 $times = Apparel::times();

 $publishers = Apparel::publisher();

 return view('cheekycamel.apparels.apparels',['apparels' => $apparels ,'apps' => $app_categorys ,'themes' => $themes ,'mechanics' => $mechanics ,
    'types' => $types ,'players' => $players ,'times' => $times ,'publishers'=>$publishers , 'ages' => $ages ]);

}


public function console_category($slug)
{
    $slug = str_replace('-',' ',$slug); //->consoles()
    $consoles = Console_category::where('category',$slug)->first()->consoles();

    $cons = Console::getConsoleByDistinctCategory();
    $themes = Console::themes();
    $mechanics = Console::mechanic();
    $types = Console::types();
    $ages = Console::ages();
    $players = Console::players();
    $times = Console::times();
    $publishers = Console::publisher();
    return view('cheekycamel.console.console',['consoles' => $consoles ,'cons' => $cons ,'themes' => $themes ,'mechanics' => $mechanics ,'types' => $types ,'ages' => $ages ,'players' => $players ,'times' => $times ,'publishers'=>$publishers]);
}


// --------------------------

// public function subscribeNewsletter(Request $request)
// {
//     print_r(config('laravel-newsletter')) ;
//     exit;
//     if(Newsletter::subscribe($request->email)) 
//     {
//         dd("ok");
//     }
//     else
//     {
//         dd("not");
//     }
// }


// ajax select theme

public function selectTheme(Request $request) 
{


    $table = $request->table;

    switch($table)
    {

        case Shop::TABLE : 
        return Shop::tabletopsFilters($request);

        break;
        case Apparel::TABLE :
        return Apparel::apparelFilters($request);
        break;
        case Console::TABLE :
        return Console::consoleFilters($request);
        break;
        default:
        echo "invalid!!";

    }
    
    
}


// contact us email 

public function contactReply(Request $request)
{

  if( Mail::to(ReplyMail::DESTINATION_EMAIL)
     ->send(new ReplyMail($request)) )
    {

        Session::flash('mail_success','Mail Sent Successfully!!');
        return  Redirect::to('/contact-us');
    }
    else
    {
        return  Redirect::to('/contact-us');
    }


}



public function calendar()
{
    $events = [];

    $CalendarEvents = CalendarEvent::all();
    
    foreach ($CalendarEvents as  $event) {
        $events[] = Calendar::event(
            $event->title,
            $event->isFullDay,
            new \DateTime($event->start_date),
            new \DateTime($event->end_date),
            $event->id,
            json_decode($event->options,true)
            );
    }


    
    $calendar = Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'header' => ['left' => 'today','center' => 'title','right' => 'prev,next',],'displayEventTime' =>true,
            ])->setCallbacks([
                'dayClick'=> 'function(date,b,c) {
                                    $("#end_date").val(date.format());
                                    $("#start_date").val(date.format());
                                    $("#createEventModal").modal();
                                  }',
                //set fullcalendar callback options (will not be JSON encoded)
                'eventClick' => 'function(event,b,c) {
                        pageObject.calendarEventClick(event,b,c);
                        
                        // change the border color just for fun
                        //$(this).css("transform", "scale(1.5)");
                            }',

    ]);
    return view('cheekycamel.calendar.calendar',compact('calendar'));
}


// cart chekout 

public function checkout(Request $request)
{
    
 Mail::to(OrderCheckout::DESTINATION_EMAIL)->send(new OrderCheckout($request));
 // return view('emails.order-checkout')->with(['request'=> $request]);
 if( count(Mail::failures()) > 0 ) {
   return response()->json(["status"=>"failed"]);
} else {
   return response()->json(["status"=>"success"]);
}

}




}
