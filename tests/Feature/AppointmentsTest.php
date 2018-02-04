<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function appointments_for_this_week_show_on_the_homepage()
    {
        $this->signIn();
        
        $appointment = create('App\Appointment');

        $this->get('/')->assertSee($appointment->title);
    }

    /** @test */
    public function authenticated_users_can_create_new_appointments()
    {
        $this->signIn();

        // Use a monday in the future
        $date = Carbon::parse('next monday')->format('d-m-Y');
        $period = 1;

        $appointment = make('App\Appointment', ['date' => $date]);

        $this->post("aanvraag/nieuw/{$date}/{$period}", $appointment->toArray());

        $this->assertDatabaseHas('appointments', ['date' => $date, 'title' => $appointment->title]);
    }

    /** @test */
    public function unauthenticated_users_can_not_make_an_appointment()
    {
        $this->withExceptionHandling();

        // Use a monday in the future
        $date = Carbon::parse('next monday')->format('d-m-Y');

        $period = 1;

        $appointment = make('App\Appointment', ['date' => $date]);

        $this->post("aanvraag/nieuw/{$date}/{$period}", $appointment->toArray())
            ->assertRedirect('/login');

        $this->assertDatabaseMissing('appointments', ['date' => $date, 'title' => $appointment->title]);

    }
}

