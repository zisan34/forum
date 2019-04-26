<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


use App\Discussion;

use Session;
use Auth;

use App\Reply;

class ForumsController extends Controller
{
    //
    public function paginate($items,$baseUrl = null, $perPage = 3, $page = null,$options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? 
                       $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), 
                           $items->count(),
                           $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }
	return $lap;
    }


    public function index()
    {
    	switch (request('filter')) {
    		case 'me':
	    		$user=Auth::user();
	    		$discussions=$user->discussions('created_at','desc')->paginate(3);
	    			break;

    		case 'opened':
	    		$result=array();

	    		foreach (Discussion::all() as $discussion) 
	    		{
	    			if(!$discussion->hasBestAns())
	    				array_push($result, $discussion);
	    		}
	    			$discussions=collect($result);

				$discussions=$this->paginate($discussions,'http://forum.local/home?filter=opened');
	    			

	    			break;

    		case 'closed':
	    		$result=array();

	    		foreach (Discussion::all() as $discussion) {
	    			if($discussion->hasBestAns())
	    				array_push($result, $discussion);

	    		}
	    			$discussions=collect($result);

				$discussions=$this->paginate($discussions,'http://forum.local/home?filter=closed');
	    			

	    			break;


    		
    		default:
	    		$discussions=Discussion::orderBy('created_at','desc')->paginate(3);
	    			break;


    	}
	    		// dd($discussions);


    	return view('index')
    	->with('discussions',$discussions);
    }
}
