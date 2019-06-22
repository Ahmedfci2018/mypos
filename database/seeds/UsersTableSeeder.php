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
        $user=App\User::create([
            'first_name'=>'super',
            'last_name'=>'admin',
            'email'=>'super@eg.com',
            'password'=>bcrypt('12345'),
        ]);
        $user->attachRole('super_admin');
    } // end of run
} //end of seeder
