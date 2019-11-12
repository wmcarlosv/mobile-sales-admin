<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'name' => 'Administador',
        		'email' => 'cvargas@frontuari.net',
        		'password' => bcrypt('Car2244los*'),
        		'role' => 'administrator'
        	],
            [
                'name' => 'armando',
                'email' => 'rojasarmando260@gmail.com',
                'password' => bcrypt('armando'),
                'role' => 'administrator'
            ]

        ]);
    }
}
