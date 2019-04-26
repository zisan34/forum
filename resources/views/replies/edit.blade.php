@extends('layouts.app')

@section('content')

@include('inc.errors')
        @if(Auth::check())
        <form action="{{ route('reply.update',['id'=>$reply->id]) }}" method="post">
        	<div class="form-group">
        		<label for="content">Update the Reply</label>
        		<textarea name="content" class="form-control" style="height: 100px;">{{$reply->content}}</textarea>
        	</div>
        	<input type="submit" name="submit" value="Update" class="btn btn-success">
        	@csrf
        </form>
        @endif

@endsection