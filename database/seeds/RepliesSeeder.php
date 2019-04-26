<?php

use Illuminate\Database\Seeder;

use App\Reply;

class RepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $r1=[
			'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
			'discussion_id'=>1,
			'user_id'=>1];
        $r2=[
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
			'discussion_id'=>1,
			'user_id'=>2];
        $r3=[
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
			'discussion_id'=>4,
			'user_id'=>1];
        $r4=[
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
			'discussion_id'=>3,
			'user_id'=>2];
        $r5=[
        	'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos molestias sequi repudiandae cupiditate nemo placeat, omnis. Maiores est repellendus suscipit quos minus numquam sint dicta ipsa debitis necessitatibus, eaque laborum.',
			'discussion_id'=>2,
			'user_id'=>2];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);
        Reply::create($r5);
    }
}
