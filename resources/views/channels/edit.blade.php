@extends('layouts.app')
@section('content')

<div class="card">
	<div class="card-header">Update Channel</div>
	<div class="card-body">
		@include('inc.errors')
		<form action="{{ route('channels.update',['channel'=>$channel->id]) }}" method="POST" class="form">
			<div class="form-group">
				<label>Channel Title</label>
				<input type="text" name="title" class="form-control" required value="{{$channel->title}}">
			</div>
			@csrf
			{{method_field('PUT')}}
			<div class="text-center">
			<input type="submit" class="btn btn-success" value="Update Channel">
			</div>
		</form>
	</div>
</div>

<br>


@endsection