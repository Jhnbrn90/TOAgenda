<?php

namespace App;


use Carbon\Carbon;

class Weekdays {

    private $date;
    private $firstDate;
    private $fullWeekArray;
    private $weekdays;

    /**
     * Weekdays constructor.
     * @param string $date
     */
    public function __construct($date = 'now')
    {
        $this->date = $date;
        $this->getFirstWeekday();
        $this->getFullWeek();
        $this->filterWeekdays();
    }

    public static function getWeekdaysFor($date)
    {
        return (new self($date))
            ->formattedArray();
    }
    
    public function formattedArray()
    {
        return collect($this->weekdays)
            ->flatmap(function($weekday) {
                return [
                    ucfirst($weekday->formatLocalized('%A')) => ucfirst($weekday->formatLocalized('%d %h'))
                ];
            })
            ->toArray();
    }

    public function filterWeekdays()
    {
        $week = collect($this->fullWeekArray)
            ->filter(function($day) {
                return $day->isWeekday();
            })
            ->values()
            ->toArray();

        return $this->weekdays = $week;
    }

    public function getFirstWeekday()
    {
        $date = Carbon::parse($this->date);

        $firstDate = $this->excludeWeekend($date);

        return $this->firstDate = $firstDate;
    }

    public function getFullWeek()
    {
        $start = Carbon::parse($this->firstDate);

        $fullWeekArray[] = clone $start;

        while(count($fullWeekArray) < 7) {
            $fullWeekArray[] = clone $start->addDays(1);
        }

        return $this->fullWeekArray = $fullWeekArray;
    }

    public function excludeWeekend($date)
    {
        if ($date->isWeekend()) {
            $date = $date->addDay(1);
            $this->excludeWeekend($date);
        }

        return $date;
    }

    public static function getToday()
    {
        return ucfirst((Carbon::now())->formatLocalized('%A'));
    }
}