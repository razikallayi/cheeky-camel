<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Subscribeduser;
use App\Mail\SubscribeMail;
use Mail;
use Redirect;
use Session;


class SubscribeController extends Controller
{
   // page

	public function index()
	{

		$lists = Subscribeduser::getSubscribedLists();
		return view('admin.users.subscribed-users',['lists' => $lists]);
	}


	// store subscribers

	public function Subscribe(Request $request)
	{
		$this->validate($request,[
			'email' => 'required',
			]);

		$subscribe = new Subscribeduser;
		$res = $subscribe->checkSubscribedList($request);
		
		if($res==0)
		{
		
  			Mail::to($request->email)
  			 ->send(new SubscribeMail($request)) ;
  	 				
  			$subscribe->storeSubcribers($request);
      		Session::flash('subscribed_success','You are subscribed Successfully!!');
    		return  Redirect::to('/');
		

	  	}
	  elseif($res>0)
		{
			Session::flash('email_exist','You have already subscribed!!!');
			return Redirect::to('/');
		}
		

	}


	// delete lists 

	public function deletes($id=null)
	{
		$subscribe = new Subscribeduser;
		$subscribe->deleteSubscribers($id);
		return back();
	}

	
}
