<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function appointments_for_this_week_show_on_the_homepage()
    {
        $this->signIn();

        $appointment = create('App\Appointment', [
            'user_id'     => auth()->id(),
            'date'        => $date = Carbon::parse('next weekday')->format('d-m-Y'),
            'period'      => $period = 1,
            ]);

        $this->assertDatabaseHas('appointments', [
            'title' => $appointment->title,
            'body'  => $appointment->body
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

        $appointment = make('App\Appointment', ['user_id' => auth()->id(), 'date' => $date]);

        $this->post("aanvraag/nieuw/{$date}/{$period}", $appointment->toArray())
            ->assertRedirect('/login');

        $this->assertDatabaseMissing('appointments', ['date' => $date, 'title' => $appointment->title]);
    }

    /** @test */
    public function guests_can_not_delete_appointments()
    {
        $this->withExceptionHandling();

        $appointment = create('App\Appointment', ['user_id' => '221']);

        $this->delete("/aanvraag/{$appointment->id}")
            ->assertRedirect('/login');

        $this->signIn();

        $this->delete("/aanvraag/{$appointment->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_their_appointments()
    {
        $this->signIn();

        $appointment = create('App\Appointment', ['user_id' => auth()->id()]);

        $response = $this->delete("/aanvraag/{$appointment->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('appointments', $appointment->toArray());
    }
}
