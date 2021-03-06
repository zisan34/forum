<?php

use Illuminate\Database\Seeder;

use App\Discussion;

class DiscussionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $t1='Wordpress Problem';
        $t2='Laravel Problem';
        $t3='Vue.js Problem';
        $t4='React.js Problem';
        $t5='Spring Problem';


        $d1=[
        	'title'=>$t1,
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
        	'channel_id'=>1,
        	'user_id'=>1,
        	'slug'=>str_slug($t1)];
        $d2=[
        	'title'=>$t2,
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
        	'channel_id'=>2,
        	'user_id'=>1,
        	'slug'=>str_slug($t2)];
        $d3=[
        	'title'=>$t3,
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
        	'channel_id'=>3,
        	'user_id'=>2,
        	'slug'=>str_slug($t3)];
        $d4=[
        	'title'=>$t4,
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
        	'channel_id'=>6,
        	'user_id'=>2,
        	'slug'=>str_slug($t4)];
        $d5=[
        	'title'=>$t5,
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
        	'channel_id'=>7,
        	'user_id'=>2,
        	'slug'=>str_slug($t5)];

        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);
        Discussion::create($d5);

    }
}
