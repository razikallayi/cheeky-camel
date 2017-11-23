<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Models\Gift_category;
use Redirect;
use Session;


class GiftcategoryController extends Controller
{
    // index 

    public function index()
    {
    	return view('admin.gifts.add-category');

    }

    public function add(Request $request)
    {
    	$this->validate($request,[
			'category' => 'required' ,
			]);
		$cats = new Gift_category;
		$cats->saveCategory($request);
		return back();
    }

    public function manage()
    {
    	$category = Gift_category::getCategory();
		return view('admin.gifts.manage-gift-category',['category'=>$category]);
    }


    public function edit($id=null)
	{
		$category = Gift_category::getCategory($id);

		return view('admin.gifts.edit-gift-category',['category' => $category]);
	}

	public function update(Request $request)
	{
		$this->validate($request,[
			'category' => 'required' ,
			]);
		$cats= Gift_category::updateCategory($request);
		
		return back();
	}


	public function deletes($id)
	{
		$category = Gift_category::deleteCategory($id);
		return back();
	}


	public function delete($id)
	{

		$category = Gift_category::deleteCategory($id);
		if($category == true)
		{
			return back();
		}
		else
		{
			Session::flash('fails',' Oops.. An item is exists in this category !!');
			return Redirect::to('admin/gift/category');
		}
	}
}
