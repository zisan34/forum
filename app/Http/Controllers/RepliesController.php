<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Notification;

use App\Reply;

use App\Like;

use App\User;
use App\Follower;
use App\Discussion;




use Session;

use Auth;

class RepliesController extends Controller
{
    //
    public function store(Request $request,$d_id)
    {
    	# code...
    	$this->validate($request,[
    		'content'=>'required'
    	]);
    	$reply=new Reply;

    	$reply->content=$request->content;
    	$reply->discussion_id=$d_id;
    	$reply->user_id=Auth::id();

    	if($reply->save())
    	{
    		$user=$reply->user;
    		$user->points+=50;
    		$user->save();
    		$followers=array();
    		$discussion=Discussion::find($d_id);

    		foreach ($discussion->followers as $follower) 
    		{
    			array_push($followers,User::find($follower->user_id));
    		}

    		Notification::send($followers,new \App\Notifications\NewReplyAdded($discussion));

    		Session::flash('success','You replied to this Discussion');
    		return redirect()->back();
    	}
    }

    public function like_unlike($reply_id)
    {
    	$like=Like::where('reply_id',$reply_id)->where('user_id',Auth::id())->first();
    	
    	if($like)
    	{

    		$like->delete();
    	}

    	else
    	{

    	Like::create([
    		'reply_id'=>$reply_id,
    		'user_id'=>Auth::id()
    	]);

    	}
    	return redirect()->back();
    }
    public function delete($id)
    {
    	$reply=Reply::find($id);
    	if(Auth::id()==$reply->user_id)
    	{
    		$reply->delete();
    		Session::flash('error','Reply deleted!');
    		return redirect()->back();
    	}
    }
    public function mark_as_best($id)
    {
    	$reply=Reply::find($id);
    	$discussion=$reply->discussion;    	
    	if(Auth::id()==$discussion->user->id)
    	{

    	$reply->best_answer=1;

    	if($reply->save())
    	{
    		$user_id=$reply->user->id;
    		$user=User::find($user_id);
    		$user->points+=50;
    		$user->save();
    		Session::flash('success','Marked the reply as best!');
    		return redirect()->back();
    	}
    	}
    }
    public function edit($id)
    {
        $reply=Reply::find($id);

        if($reply->user_id==Auth::id()&&$reply->best_answer==0)
        {
            return view('replies.edit')->with('reply',$reply);

        }
        return redirect()->back();
    }
    public function update(Request $request,$id)
    {
        $reply=Reply::find($id);

        $this->validate($request,[
            'content'=>'required']);

        $reply->content=$request->content;
        $reply->save();
        return redirect()->route('discussion.show',['slug'=>$reply->discussion->slug]);
    }
}
