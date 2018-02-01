<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\WeekdaysCollection;

class AppointmentsTest extends TestCase
{

    /** @test */
    public function the_homepage_shows_the_correct_dates_for_the_week()
    {
     $weekdays = WeekdaysCollection::getWeekdaysFor('now');

     foreach ($weekdays as $weekday => $date) {
         $weekdaysArray[] = [$weekday => $date];
     }

     $this->get('/')
         ->assertSee(
         ucfirst((Carbon::now())
             ->formatLocalized('%d %h'))
         )
         ->assertSee(
             ucfirst((Carbon::now())
             ->formatLocalized('%e'))
         )
         ->assertSee(
             ucfirst((Carbon::now())
                 ->addDay(1)
                 ->formatLocalized('%d %h'))
         )
        ->assertDontSee(
            ucfirst((Carbon::now())
            ->subDay(1)
            ->formatLocalized('%d %h'))
        );

    }

//    /** @test */
//    public function an_authenticated_user_can_see_all_appointments()
//    {
//      //
//    }
}
