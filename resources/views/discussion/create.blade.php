@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-header text-center">Create a New Discussion</div>
	<div class="card-body">
		@include('inc.errors')
		<form action="{{ route('discussion.store') }}" method="POST">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control"  value="{{old('title')}}">
			</div>
			<div class="form-group">
				<label for="channel_id">Select a Channel</label>
			<select name="channel_id" class="form-control" >
				@foreach($channels as $channel)
				<option value="{{$channel->id}}"
					@if(old('channel_id')==$channel->id)
					selected
					@endif 

					>{{$channel->title}}</option>
				@endforeach
			</select>
			</div>

			<div class="form-group">
				<label for="content">Ask a question.</label>
				<textarea type="textarea" name="content" class="form-control" >{{old('content')}}</textarea>
			</div>
			@csrf
			<div class="text-center">
			<input type="submit" class="btn btn-success" value="Post Discussion">
			</div>
		</form>
	</div>
</div>

<br>


@endsection