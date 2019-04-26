@extends('layouts.app')
@section('content')

@include('inc.errors')

<div class="card">
	<div class="card-header">
		Discussions
	</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<th>Title</th>
				<th>Channel</th>
				<th>Posted By</th>
			</thead>
			@foreach($discussions as $discussion)
			<tr>
				<td><a href="{{ route('discussion.show',['slug'=>$discussion->slug]) }}">{{$discussion->title}}</a></td>
				<td>
					{{$discussion->channel->title}}
				</td>
				<td>
					{{$discussion->user->name}}
				</td>				
			</tr>
			@endforeach
		</table>
	</div>
</div>

@endsection