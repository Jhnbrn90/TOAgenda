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

    public function today()
    {
        return Carbon::today()->endOfDay();
    }

}
