<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event as CalendarEvent;
use Carbon\Carbon;
use Calendar;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                    'header' => ['left' => 'today','center' => 'title','right' => 'prev,next',],'displayEventTime' =>false,
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
                            //$(this).css("cursor","pointer");
                                }',

        ]);
        return view('admin/calendar/add-event',compact('calendar'));
}



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
        //Validate the Request
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'end_date'   => 'required',
        ]);
// |date_format:Y-m-d
        $startDate = new Carbon($request->start_date);
        
        $options = [];
        
        if(isset($request->repeat)){
            $options['dow'] = [$startDate->dayOfWeek];
        }
        $request['options'] = json_encode($options);

        $eventExist = CalendarEvent::where('start_date',$request->start_date)
                    ->where('end_date',$request->end_date)
                    ->where('title','LIKE',$request->title)
                    ->count();
        if(! $eventExist){
            CalendarEvent::create($request->all());
        }
        return $this->index();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        //Validate the Request
        $this->validate($request, [
            'id' => 'required',
        ]);
        CalendarEvent::find($request->id)->delete();
        return $this->index();
    }
}
