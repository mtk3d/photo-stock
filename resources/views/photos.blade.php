@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container">
    	<h1>My photos</h1>
</div>
<div class="container-fluid thumbnails">
    	@foreach ($photos as $photo)
       	<a href="{{ url('/photos') }}/{{ $photo->id }}"><img src="storage/images/thumbnails/{{ $photo->name }}.jpg" alt="..." class="img-thumbnail"></a>
	@endforeach
</div>
@endsection