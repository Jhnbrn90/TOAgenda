<?php

use Illuminate\Database\Seeder;

class AppointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Appointment', 10)->create();
    }
}
