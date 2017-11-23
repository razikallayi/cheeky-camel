<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Apparel_category;
use App\Http\Requests;
use Redirect;
use Session;

class ApparelCategoryController extends Controller
{
    
    public function index()
    {
    	return view('admin.apparels.add-category');
    }

    // save category

    public function category(Request $request)
    {
    	$this->validate($request,[
    		'category' => 'required' ,
    		]);
    	$category = Apparel_category::saveData($request);
    	return back();
    }

    // manage data

    public function manage()
    {
    	$category = Apparel_category::getCategory();
    	return view('admin.apparels.manage-apparels',['category' => $category]);
    }

    // edit data 

    public function edit($id=null)
    {
    	$category = Apparel_category::getCategory($id);
    	return view('admin.apparels.edit-category',['category' => $category]);
    }


    // update data

    public function update(Request $request)
    {
    	$this->validate($request,[
    		'category' => 'required',
    		]);
    	$cats = new Apparel_category;
    	$cats->updateCategory($request);
    	return back();
    }

    // delete category

    public function deletes($id)
    {
    	$cats = new Apparel_category;
    	$result = $cats->deleteCategory($id);
        if($result == true)
        {
            return back();
        }
        
        else
        {
            Session::flash('fails',' Oops.. An item is exists in this category !!');
            return Redirect::to('admin/apparels/catgeory');
        }
    	
    }

}
