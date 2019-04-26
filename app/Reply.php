<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $fillable = [
        'content', 'discussion_id', 'user_id', 'best_answer'
    ];

    public function discussion()
    {
    	return $this->belongsTo('App\Discussion');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function hasLiked()
    {
        foreach ($this->likes as $like) {
            if($like->user->id==Auth::id())
            {
                return true;
            }
        }
    }
}
