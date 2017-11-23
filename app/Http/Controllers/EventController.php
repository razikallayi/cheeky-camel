<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests;


class EventController extends Controller
{

	public function index()
    {
    	
    	return view('admin.event.add-event');
    }

    public function addEvent(Request $request)
    {
    	$event = Event::storeEvent($request);
    	return back();
    }

    public function manage()
    {
    	$events = Event::getEvents();
    	return view('admin.event.manage-event',compact('events'));
    }

    public function edit($id = null)
    {
    	$event = Event::getEvents($id);
    	return view('admin.event.edit-event',compact('event'));
    }


    public function update(Request $request)
    {

    	$event = Event::updateEvents($request);
    	return back();
    }


    // delete

    public function deletes($id)
    {
    	$event = Event::deleteEvent($id);
    	return back();
    }







}
