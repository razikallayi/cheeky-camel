<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model implements \MaddHatter\LaravelFullcalendar\IdentifiableEvent
{
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['title','is_full_day','start_date','end_date','options'];


        protected $dates = ['start', 'end'];

        /**
         * Get the event's id number
         *
         * @return int
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Get the event's title
         *
         * @return string
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * Is it an all day event?
         *
         * @return bool
         */
        public function isAllDay()
        {
            return (bool)$this->all_day;
        }

        /**
         * Get the start time
         *
         * @return DateTime
         */
        public function getStart()
        {
            return $this->start;
        }

        /**
         * Get the end time
         *
         * @return DateTime
         */
        public function getEnd()
        {
            return $this->end;
        }

        /**
            * Optional FullCalendar.io settings for this event
            *
            * @return array
            */
           public function getEventOptions()
           {
               return [
                   'color' => $this->background_color,
               ];
           }   

}
