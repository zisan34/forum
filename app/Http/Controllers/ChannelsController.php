<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;

use Session;
class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('channels.index')
        ->with('channels',Channel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title'=>'required']);
        $channel=Channel::create([
            'title'=>$request->title]);

        Session::flash('success','Channel created successfullly');
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $channel=Channel::find($id);
        $discussions=$channel->discussions()->paginate(4);
        return view('index')->with('discussions',$discussions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $channel=Channel::find($id);
        return view('channels.edit')->with('channel',$channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'title'=>'required']);
        $channel=Channel::find($id);
        $channel->title=$request->title;
        if($channel->save())
        {
        Session::flash('success','Channel Updated successfullly');
        return redirect()->route('channels.index');

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
        if(Channel::destroy($id))
        {
            Session::flash('success','Channel Deleted successfullly');
            return redirect()->route('channels.index');

        }

    }
}
