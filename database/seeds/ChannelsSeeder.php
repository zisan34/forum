<?php

use Illuminate\Database\Seeder;

use App\Channel;

class ChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $c1=[
        	'title'=>'Wordpress'];
        $c2=[
        	'title'=>'Laravel'];
        $c3=[
        	'title'=>'Vue.js'];
        $c4=[
        	'title'=>'Javascript'];
        $c5=[
        	'title'=>'Laravel Spark'];
        $c6=[
        	'title'=>'React.js'];
        $c7=[
        	'title'=>'Spring'];
        $c8=[
        	'title'=>'ASP.NET'];
        $c9=[
        	'title'=>'Lumen'];

        Channel::create($c1);
        Channel::create($c2);
        Channel::create($c3);
        Channel::create($c4);
        Channel::create($c5);
        Channel::create($c6);
        Channel::create($c7);
        Channel::create($c8);
        Channel::create($c9);




    }
}
