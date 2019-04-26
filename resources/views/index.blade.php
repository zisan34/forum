@extends('layouts.app')
@section('content')

@include('inc.errors')

@if($discussions->count()>0)
@foreach($discussions as $discussion)
<div class="card">
    <div class="card-header">
        <img src="{{$discussion->user->avatar}}" height="40px">{{$discussion->user->name}}
        <small style="color:green;"><b>({{$discussion->user->points}})</b></small>
        , <b>{{$discussion->created_at->diffForHumans()}}</b>
        <a href="{{ route('channels.show',['channel'=>$discussion->channel->id]) }}" class="float-right">
            {{$discussion->channel->title}}
        </a>
        @if($discussion->hasBestAns())
        <button type="button" class="btn btn-dark btn-sm" disabled><img src="{{ asset('related/check-mark.png') }}" height="15px">Solved</button>
        @else
        <button type="button" class="btn btn-secondary btn-sm" disabled> Unsolved</button>
        @endif

        
    </div>
    <div class="card-body text-center">
        <h4><a href="{{ route('discussion.show',['slug'=>$discussion->slug]) }}" style="text-decoration: none;">{{$discussion->title}}</a>
        </h4>

        <hr>

        {{str_limit($discussion->content,80)}} <a href="{{ route('discussion.show',['slug'=>$discussion->slug]) }}" style="text-decoration: none;">See more</a>
    </div>
    <div class="card-footer">
        @if(count($discussion->replies)>1)
        {{count($discussion->replies)}} Replies
        @else
        {{count($discussion->replies)}} Reply
        @endif
        @if(Auth::user()==$discussion->user&&!$discussion->hasBestAns())
        <div class="float-right">
            <a href="{{ route('discussion.edit',['slug'=>$discussion->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
        </div>
        @endif

    </div>
</div>
<br>
@endforeach

<br>
<div class="nav justify-content-center">
    {{$discussions->links()}}
</div>

@else

<div class="card">
    <div class="card-header"><h3 class="text-center">No Discussions available</h3></div>
</div>
@endif

@endsection