<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
        	'name' => 'Admin',
        	'email' => 'admin@admin.com',
        	'email_verified_at' => date("Y-m-d H:i:s"),
        	'password' => bcrypt('verysafepassword'),
        	'admin' => 1,
        	'approved_at' => date("Y-m-d H:i:s")
        ]);
    }
}
