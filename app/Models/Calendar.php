<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    // store 

    protected $fillable = ['event','start_date_of_event','end_date_of_event'];

    public static function addCalendar($request)
    {
    
    	$cal = new Calendar;
    	$cal->event = $request->title;
    	$cal->start_date_of_event =$request->date;
    	$cal->end_date_of_event = $request->date;
    	$cal->save();
    	return true;  
    }

    // get calendar data 

    public static function getCalendar($id=null)
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
}
