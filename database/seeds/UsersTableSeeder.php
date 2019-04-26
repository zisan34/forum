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
        //
        App\User::create([
        	'name'=>'admin',
        	'password'=>bcrypt('admin'),
        	'email'=>'admin@forum.local',
        	'admin'=>1,
        	'avatar'=> asset('avatar/avatar.png')
        ]);
        App\User::create([
            'name'=>'fazlul',
            'password'=>bcrypt('123456'),
            'email'=>'fazlul@forum.local',
            'avatar'=> asset('avatar/avatar.png')
        ]);
    }
}
