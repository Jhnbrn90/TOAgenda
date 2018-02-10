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
        
        // Create an appointment on a random day this week
        // (See ModelFactory)
        $appointment = create('App\Appointment');

        // $this->get('/')->assertSee($appointment->title);
        // assert that the appointments array for this week has our appointment
        $this->getJson('/api/appointments')
            ->assertJsonFragment([
                'title' => $appointment->title,
                'body' => $appointment->body
                ]);
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

