<?php

namespace Tests\Feature;

use App\WeekdaysCollection;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeekdaysCollectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_homepage_shows_the_correct_dates_for_the_week()
    {
        $this->signIn();
        // Retrieve the collection of weekdays for today
        $weekdays = (new WeekdaysCollection(Carbon::today()))->array();

        $homepage = $this->get('/');

        foreach($weekdays as $weekday) {
            $homepage->assertSee($weekday->name, $weekday->day_month);
        }


    }

}
