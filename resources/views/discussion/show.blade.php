@extends('layouts.app')
@section('content')

@include('inc.errors')

<div class="card">
    <div class="card-header">
        <img src="{{$discussion->user->avatar}}" height="40px" style="border-radius: 50%;">{{$discussion->user->name}}<small style="color:green;"><b>({{$discussion->user->points}})</b></small> <b>{{$discussion->created_at->diffForHumans()}}</b>
        @if(Auth::check())

        	@if(Auth::id()==$discussion->user_id)
        	<div class="float-right">
        		<a href="{{ route('discussion.edit',['slug'=>$discussion->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
        	</div>
        	@else

	        <span class="float-right"><a 

	        	@if($discussion->isFollowing())
	        	href="{{ route('discussion.unfollow',['id'=>$discussion->id]) }}" class="btn btn-danger">Unfollow
	        	@else
	        	href="{{ route('discussion.follow',['id'=>$discussion->id]) }}" class="btn btn-info">Follow
	        	@endif


	        </a></span>
	        @endif
        @endif
        
    </div>
    <div class="card-body">
        <h4>{{$discussion->title}}
        </h4>

        <hr>

        {!!Markdown::convertToHtml($discussion->content)!!}
    </div>
    <div class="card-footer">
    	<h4>
    		<b>
		        @if(count($discussion->replies)>1)
		        {{count($discussion->replies)}} Replies
		        @else
		        {{count($discussion->replies)}} Reply
		        @endif    			
    		</b>
    	</h4>
    	<hr>


    	<div class="container text-justify">
			@php
				$best_answer_id=0
			@endphp
    		@foreach($discussion->replies as $reply)
				@if($reply->best_answer)
					@php
						$best_answer_id=$reply->id;
					@endphp
				@endif
    		@endforeach


        @foreach($discussion->replies as $reply)

        <div class="row">

            <div class="col-sm-10 text-left">

                <img src="{{$reply->user->avatar}}" height="40px" style="border-radius: 50%;">
                <b>{{$reply->user->name}}</b><small style="color:green;"><b>({{$discussion->user->points}})</b></small>
                <small>{{$reply->created_at->diffForHumans()}}</small>
                <br>
                {!!Markdown::convertToHtml($reply->content)!!}
            </div>
            <div class="col-sm-2 text-center">
            	<br><br>
				
		@if($best_answer_id>0)
			@if($reply->id==$best_answer_id)
				<img src="{{ asset('related/check-mark.png') }}" height="30px" alt="marked as best"><strong style="color: green;">Marked as best</strong>

			@endif

		@else
			@if(Auth::id()==$discussion->user->id)
	    		<a href="{{ route('reply.mark',['id'=>$reply->id]) }}" style="text-decoration: none;">
	            <img src="{{ asset('related/check-mark.png') }}" height="30px" alt="mark as best">
	    			Mark as best answer</a>
	    		@endif

		@endif



    		
            </div>



        <div class="container">
        	
        	<small class="" style="color: #00AE9C;">
        		<br>
        		@if(Auth::check())
        		<form  action="{{ route('reply.like_unlike',['id'=>$reply->id]) }}" method="post" style="float: left;">
        			@csrf
        			<input type="submit" class="btn btn-sm
        			@if($reply->hasLiked())
        			 btn-danger" value="Unlike">
        			@else
        			 btn-info" value="LIke">
        			@endif

        			

        			
        		</form>

        		<span>
        			&nbsp;
        			@if($reply->likes->count()>1)
        			{{$reply->likes->count()}} Likes
        			@else
        			{{$reply->likes->count()}} Like
        			@endif
        		</span>

        		@if(Auth::id()==$reply->user_id)

				@if($reply->id!=$best_answer_id)


        		<span class="float-right">
        			<a href="{{ route('reply.edit',['id'=>$reply->id]) }}" class="btn btn-sm btn-info">Edit</a>

        			<a href="{{ route('reply.delete',['id'=>$reply->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        		</span>
        		@endif
        		@endif
        		


        		@else

        			@if($reply->likes->count()>1)
        			{{$reply->likes->count()}} Likes
        			@else
        			{{$reply->likes->count()}} Like
        			@endif

        		@endif
        	</small>
        </div>
        </div>
        <hr>
        @endforeach
        @if(Auth::check())
        <form action="{{ route('reply.store',['d_id'=>$discussion->id]) }}" method="post">
        	<div class="form-group">
        		<label for="content">Leave a Reply</label>
        		<textarea name="content" class="form-control" style="height: 100px;"></textarea>
        	</div>
        	<input type="submit" name="submit" value="Reply" class="btn btn-success">
        	@csrf
        </form>
        @endif

    </div>
    </div>
</div>


@endsection