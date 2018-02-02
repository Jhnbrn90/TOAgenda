<?php

namespace Tests\Unit;

use App\Weekday;
use App\WeekdaysCollection;
use Carbon\Carbon;
use Tests\TestCase;

class WeekdaysTest extends TestCase
{
   /** @test */
   public function it_can_create_an_array_of_5_upcoming_weekdays_from_a_starting_date()
   {
       // Given we have a new WeekdaysCollection
       // starting from Monday 29 january 2018
       $week = new WeekdaysCollection('29-01-2018');

       // When we generate an array of the weekdays
       $weekdays = $week->array();

       // Then we expect to match the following array
       // of Weekday objects
       $expected = [
           new Weekday(Carbon::parse('29-01-2018')),
           new Weekday(Carbon::parse('30-01-2018')),
           new Weekday(Carbon::parse('31-01-2018')),
           new Weekday(Carbon::parse('01-02-2018')),
           new Weekday(Carbon::parse('02-02-2018')),
       ];

       $this->assertEquals($expected, $weekdays);

   }
   
   /** @test */
   public function days_in_the_weekend_are_skipped()
   {
       // Given we have a new WeekdaysCollection
       // starting on a Saturday (Saturday 03-02-2018)
       $week = new WeekdaysCollection('03-02-2018');

       // When we generate an array of the weekdays
       $weekdays = $week->array();

       // Then we expect the first element in
       // the array to be the next Monday (05-02-2018)
       $this->assertEquals(Carbon::parse('05-02-2018'), $weekdays[0]->carbon);

       // starting on a Sunday (Sunday 04-02-2018)
       $week = new WeekdaysCollection('04-02-2018');

       // When we generate an array of the weekdays
       $weekdays = $week->array();

       // Then we expect the first element in
       // the array to be the next Monday (05-02-2018)
       $this->assertEquals(Carbon::parse('05-02-2018'), $weekdays[0]->carbon);
   }
   
}
