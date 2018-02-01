<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeekdaysTest extends TestCase
{
   /** @test */
   public function it_can_create_an_array_of_5_upcoming_weekdays_from_a_starting_date()
   {
       $weekdays = new Weekdays('30-01-2018');

       $weekdays->toArray();

       // 
       
   }
   
   /** @test */
   public function days_in_the_weekend_are_skipped()
   {
       
   }
   
}
