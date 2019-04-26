<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Newsletter;

class mailchimpController extends Controller
{
    //
    public function store(Request $request)
{
    if ( ! Newsletter::isSubscribed($request->email) ) {
        Newsletter::subscribePending($request->email);
        return redirect()->back()->with('success','Successfully sent mail for confirmation!');
    }
        return redirect()->back()->with('success','Already subscribed!');

}
}
