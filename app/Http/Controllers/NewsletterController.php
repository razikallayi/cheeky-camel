<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Subscribeduser;
use App\Mail\NewslettersMail;
use Mail;
use Session;
use Redirect;

class NewsletterController extends Controller
{
    protected $fillable = ['description','users'];

    // newsletter 

	public function index()
	{
		return view('admin.users.newsletter');
	}


	// sending newsletter

	public function sendNewsletter(Request $request)
	{

		$this->validate($request,[
			'description' => 'required',
			'users' => 'required',
			]);
		Newsletter::storeNewsletter($request);
		$emails = Subscribeduser::getSubscribedLists();

		if(!$emails->isEmpty())
		{
			
			foreach($emails as $email)
			{

				Mail::to($email->email)
				->send(new NewslettersMail($request)) ;

			}
			Session::flash('success_newsletter','Your Newsletter has been sent successfully !!!');
			return Redirect::to('admin/users/newsletter');
		}
		else
		{
			Session::flash('empty_email','Sorry !! No Subscribed users in the List.. ');
			return Redirect::to('admin/users/newsletter');

		}
	
		
	}


}
