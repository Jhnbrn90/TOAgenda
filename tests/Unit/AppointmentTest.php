<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    protected $appointment;

    public function setUp() 
    {
       parent::setUp();
       $this->appointment = create('App\Appointment'); 
    }

    /** @test */
    function an_appointment_can_return_its_path()
    {
        $this->assertEquals("appointments/{$this->appointment->id}", $this->appointment->path());
    }

    /** @test */
    public function an_appointment_belongs_to_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->appointment->creator);
    }
}
