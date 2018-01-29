<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Weekdays;

class AppointmentsTest extends TestCase
{

    /** @test */
    public function the_homepage_shows_the_correct_dates_for_the_week()
    {
     $weekdays = Weekdays::getDaysFor('now');
     
     $this->get('/')->assertSee($weekdays[0]['day']);

    }

    /** @test */
    public function an_authenticated_user_can_see_all_appointments()
    {
      //
    }
}
