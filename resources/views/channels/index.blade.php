@extends('layouts.app')
@section('content')

@include('inc.errors')

<div class="card">
	<div class="card-header">Create Channel</div>
	<div class="card-body">
		<form action="{{ route('channels.store') }}" method="POST">
			<div class="form-group">
				<label>Channel Title</label>
				<input type="text" name="title" class="form-control" required>
			</div>
			@csrf
			<div class="text-center">
			<input type="submit" class="btn btn-success" value="Create Channel">
			</div>
		</form>
	</div>
</div>

<br>

<div class="card">
	<div class="card-header">
		Channels
	</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Edit</th>
				<th>Delete</th>


			</thead>
			@foreach($channels as $channel)
			<tr>
				<td>{{$channel->title}}</td>
				<td><a class="btn btn-sm btn-info" href="{{ route('channels.edit',['channel'=>$channel->id]) }}">Edit</a></td>
				<td>
					<form action="{{ route('channels.destroy',['channel'=>$channel->id]) }}" method="POST">
						{{csrf_field()}}
						{{method_field('DELETE')}}

					<input type="submit" name="update" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" value="Delete">
					</form>
				</td>				
			</tr>
			@endforeach
		</table>
	</div>
</div>

@endsection