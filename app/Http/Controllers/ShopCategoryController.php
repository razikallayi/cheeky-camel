<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Shop_category;
use App\Http\Requests;
use Redirect;
use Session;

class ShopCategoryController extends Controller
{
    // index page

	public function index()
	{
		return view('admin.shop.add-shopcategory');
	}


    // ############## shop category ####################  //

	public function  category(Request $request)
	{
		$this->validate($request,[
			'category' => 'required' ,
			]);
		$cats = new Shop_category;
		$cats->saveCategory($request);
		return back();
	}


	// ##################### manage category ################ //

	public function manage()
	{
		$category = Shop_category::getCategory();
		return view('admin.shop.manage-shop-category',['category'=>$category]);
	}


	// ######################### edit ########################## //


	public function edit($id=null)
	{
		$category = Shop_category::getCategory($id);

		return view('admin.shop.edit-shop-category',['category' => $category]);
	}

	// ######################### update ########################### ??

	public function update(Request $request)
	{
		$this->validate($request,[
			'category' => 'required' ,
			]);
		$cats= Shop_category::updateCategory($request);
		
		return back();
	}

	// ################# delete ################# //

	public function deletes($id)
	{
		$category = Shop_category::deleteCategory($id);
		if($category == true)
		{
			return back();
		}
		
		else
		{
			Session::flash('fails',' Oops.. An item is exists in this category !!');
			return Redirect::to('admin/manage/category');
		}
		
	}
}
