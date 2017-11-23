<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Models\Console_category;
use Redirect;
use Session;

class ConsoleCategoryController extends Controller
{
    // index page

	public function index()
	{
		return view('admin.console.add-category');
	}

    // category save

	public function category(Request $request)
	{
		$this->validate($request,[
			'category' => 'required' ,
			]);
		Console_category::saveData($request);
		return back();

	}

	// manage 

	public function manage()
	{
		
		$category = Console_category::getCategory();
		return view('admin.console.manage-category',['category' => $category]);
	}

	// edit the data

	public function edit($id = null)
	{
		$category = Console_category::getCategory($id);
		return view('admin.console.edit-category',['category' => $category]);
	}

	// update 


	public function update(Request $request)
	{
		$this->validate($request,[
			'category' => 'required' ,
			]);

		Console_category::updateCategory($request);
		return back();
	}

	// delete category

	public function deletes($id)
	{

		$result = Console_category::deleteCategory($id);
		if($result == true)
		{
			return back();
		}
		else
		{
			Session::flash('fails',' Oops.. An item is exists in this category !!');
			return Redirect::to('admin/console/category');
		}
		
	}
}
