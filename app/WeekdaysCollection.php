<?php

namespace App;

use Carbon\Carbon;
use App\Weekday;

class WeekdaysCollection {

    protected $date;

    /**
     * WeekdaysCollection constructor.
     * @param string $date
     */
    public function __construct($date = 'now')
    {
        $this->date = Carbon::parse($date);
    }

    public function array()
    {
         if ($this->date->isWeekend()) {
             $this->date = $this->date->addWeek();
         }

         $this->date = clone $this->date->startOfWeek();

         $weekdaysArray = [new Weekday(clone $this->date)];

         while(count($weekdaysArray) < 5) {
             $weekdaysArray[] = new Weekday((clone $this->date->addDays(1)));
         }

         return $weekdaysArray;
    }

    public function json() 
    {
        $weekdays = $this->array();
        
        $newArray = [];

        foreach ($weekdays as $weekday) {
            $newArray[$weekday->carbon->format('d-m-Y')] = [
                'name' => $weekday->name,
                'today' => $weekday->isToday(),
                'past' => $weekday->isPast()
            ];
        }

        return json_encode($newArray);
    }

    public function emptyAppointmentsArray()
    {
        $weekdays = $this->array();

        $array = [];

        foreach ($weekdays as $weekday) {

//        $array[] = $weekday->date_string;

            for ($i = 1; $i <= 7; $i++) {
                $array[$weekday->date_string][$i] = [];
            }
        }

            return $array;

    }

    public static function firstDay()
    {
        $weekdays = (new WeekdaysCollection('now'))->array();

        return $weekdays[0]->carbon->format('d-m-Y');
    }

    public static function lastDay()
    {
        $weekdays = (new WeekdaysCollection('now'))->array();

        return $weekdays[4]->carbon->format('d-m-Y');
    }

    public function today()
    {
        return Carbon::today()->endOfDay();
    }

}
