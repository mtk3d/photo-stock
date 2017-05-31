@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container">
    	<img src="{{ Storage::url('images/'.$photo->name.'.jpeg') }}" alt="..." class="image">
    	@if (Route::has('login'))
		@if (Auth::check())
			@if (Auth::id() == $photo->user_id)
    			<div class="row" style="margin-top: 20px; padding-left: 15px;">
    				<div class="image-button">
    					<a class="btn btn-primary" href="{{ url('/photos') }}/{{ $photo->id }}/edit" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
    				</div>
    				<div class="image-button">
    					<form action="/photos/{{ $photo->id }}" method="POST">
    						{{ csrf_field() }}
    						{{ method_field('DELETE') }}
    						<button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
					</form>
    				</div>
    			</div>
    			@endif
    		@endif
    	@endif
    	<h1>{{ $photo->title }}</h1>
    	<small><strong>Uploaded by {{ $user->name }}</strong> <span class="badge">{{ $photo->views }} views</span></small>
    	<p>{{ $photo->description }}</p>
</div>
@endsection