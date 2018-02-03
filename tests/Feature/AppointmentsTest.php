<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function appointments_for_this_week_show_on_the_homepage()
    {
        $appointment = create('App\Appointment');

        $this->get('/')->assertSee($appointment->title);
    }

}

