<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //

    protected $fillable = [
        'title', 'content', 'user_id','channel_id'
    ];

    public function channel()
    {
    	return $this->belongsTo('App\Channel');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function replies()
    {
    	return $this->hasMany('App\Reply');
    }

    public function Followers()
    {
        return $this->hasMany('App\Follower');
    }
    public function isFollowing()
    {
        $user_id=Auth::id();
        foreach ($this->Followers as $follwer) {
            if($follwer->user_id==$user_id)
                return true;
        }
    }
    public function hasBestAns()
    {
        foreach ($this->replies as $reply) {
            if($reply->best_answer==1)
                return true;
        }
    }
}
