<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 5)->create();

        factory('App\User')->create([
            'email' => 'jbraunnl@gmail.com',
            'password' => bcrypt('password'),
            'name' => 'John',
        ]);
    }
}
