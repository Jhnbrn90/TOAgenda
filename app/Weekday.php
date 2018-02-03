<?php

namespace App;


use Carbon\Carbon;

class Weekday {
    public $carbon;
    public $name;
    public $date_string;
    public $day_month;


    /**
     * Weekday constructor.
     * @param Carbon $date
     */

    public function __construct(Carbon $date)
    {
        $this->carbon = $date;

        $this->name = ucfirst(
            $this->carbon->formatLocalized('%A')
        );

        $this->day_month = ucfirst(
            $this->carbon->formatLocalized('%d %h')
        );

        $this->date_string = $this->carbon->format('d-m-Y');
    }

    public function isPast()
    {
        return $this->carbon->endOfDay()->isPast();
    }

    public function isToday()
    {
        return $this->carbon->isToday();
    }

}