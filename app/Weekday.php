<?php

namespace App;


use Carbon\Carbon;

class Weekday {
    public $carbon;
    public $name;
    public $date;

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

        $this->date = ucfirst(
            $this->carbon->formatLocalized('%d %h')
        );

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