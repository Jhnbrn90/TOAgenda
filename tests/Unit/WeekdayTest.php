<?php

namespace Tests\Unit;

use App\WeekdaysCollection;
use Carbon\Carbon;
use Tests\TestCase;

class WeekdayTest extends TestCase
{

    public $startDate = '05-02-2018'; // Monday 05-02-2018
    public $weekdays;

    /**
     * Set up:
     * Create a new Weekday object collection generated from $this->startDate
     * And use the WeekdayCollection->array() method to obtain an array of Weekday objects
     */
    public function setUp()
    {
        parent::setUp();

        // Given we have a collection of
        // Weekday objects starting from $this->startDate
        $this->weekdays = (new WeekdaysCollection($this->startDate))->array();
    }

    /** @test */
    function a_weekday_has_a_name()
    {
        // When we retrieve the name of the first element
        // We expect the correctly formatted name
        $this->assertEquals('Maandag', $this->weekdays[0]->name);
    }
    
    /** @test */
    function a_weekday_can_return_its_carbon_instance()
    {
        // When we retrieve the carbon instance of the first element
        // We expect the Carbon instance to be equal
        $this->assertEquals(Carbon::parse($this->startDate), $this->weekdays[0]->carbon);
    }

    /** @test */
    function a_weekday_can_return_its_formatted_date()
    {
        $this->assertEquals('05 feb', $this->weekdays[0]->date);
    }
}
