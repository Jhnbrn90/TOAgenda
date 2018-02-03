<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_appointment_can_return_its_path()
    {
        $appointment = create('App\Appointment');

        $this->assertEquals("appointments/{$appointment->id}", $appointment->path());
    }
}
