<?php

namespace Tests\Feature;

use App\WeekdaysCollection;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentsTest extends TestCase
{

    /** @test */
    public function the_homepage_shows_the_correct_dates_for_the_week()
    {
        // Retrieve the collection of weekdays for today
        $weekdays = (new WeekdaysCollection(Carbon::today()))->array();

        $homepage = $this->get('/');

        foreach($weekdays as $weekday) {
            $homepage->assertSee($weekday->name, $weekday->date);
        }

    }

//    /** @test */
//    public function an_authenticated_user_can_see_all_appointments()
//    {
//      //
//    }
}
