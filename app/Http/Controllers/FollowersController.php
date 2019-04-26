<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follower;
use Auth;
use Session;

class FollowersController extends Controller
{
    //
    public function follow($id)
    {
        $discussion=Discussion::find($id);

        if(!$discussion->isFollowing())
        {

            $follower=new Follower;
            $follower->user_id=Auth::id();
            $follower->discussion_id=$id;
            if($follower->save())
            {
                Session::flash('success','You will be notified about updates of this discussion');
                return redirect()->back();
            }
        }
    }

    public function unfollow($id)
    {
        $discussion=Discussion::find($id);

        if($discussion->isFollowing())
        {
        	$follower=Follower::where('discussion_id',$id)->where('user_id',Auth::id());
        	if($follower->delete())
        	{
        		Session::flash('error','You will not be notified about updates of this discussion anymore');
        		return redirect()->back();
        	}
        }
    }
}
