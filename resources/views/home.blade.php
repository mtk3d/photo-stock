@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container front-page-menu">
    <ul class="nav nav-pills nav-justified">
        <li role="presentation" @if($active == 'random') class="active" @endif><a href="{{ url('random') }}">Random</a></li>
        <li role="presentation" @if($active == 'newest') class="active" @endif><a href="{{ url('newest') }}">Newest</a></li>
        <li role="presentation" @if($active == 'popular') class="active" @endif><a href="{{ url('popular') }}">Popular</a></li>
        <li role="presentation" @if($active == 'top-rated') class="active" @endif><a href="{{ url('top-rated') }}">Top rated</a></li>
    </ul>
</div>
<div class="container-fluid thumbnails">
    @foreach ($photos as $photo)
        <div class="thumbnail-container">
            <img src="storage/images/thumbnails/{{ $photo->name }}.jpg" alt="..." class="img-thumbnail">
        </div>
    @endforeach
</div>
@endsection