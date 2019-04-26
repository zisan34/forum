<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;
use App\Discussion;
use App\Like;

use Session;
use Auth;


class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('discussion.index')
        ->with('discussions',Discussion::orderBy('created_at','desc')->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('discussion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'channel_id'=>'required',
            'content'=>'required']);
        $discussion=new Discussion;

        $discussion->title=$request->title;
        $discussion->channel_id=$request->channel_id;
        $discussion->content=$request->content;
        $discussion->user_id=Auth::user()->id;
        $discussion->slug=str_slug($request->title).time();

        if($discussion->save())
        {
            app('App\Http\Controllers\FollowersController')->follow($discussion->id);

            Session::flash('success','Discussion created successfully');
            return redirect()->route('home');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $discussion=Discussion::where('slug',$slug)->first();
        return view('discussion.show')
        ->with('discussion',$discussion);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $discussion=Discussion::where('slug',$slug)->first();
        return view('discussion.edit')
        ->with('discussion',$discussion);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $discussion=Discussion::where('slug',$slug)->first();

        if(Auth::id()==$discussion->user_id)
        {
            $this->validate($request,[
                'title'=>'required',
                'channel_id'=>'required',
                'content'=>'required']);

            if($request->title!=$discussion->title)
            {
                $discussion->title=$request->title;
                $discussion->slug=str_slug($request->title).time();
            }
            $discussion->channel_id=$request->channel_id;
            $discussion->content=$request->content;

            if($discussion->save())
            {
                Session::flash('success','You updated the discussion');
                return redirect()->route('discussion.show',['slug'=>$discussion->slug]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
