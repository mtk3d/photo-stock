@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container">
@if (count($errors) > 0)
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						All fields are required.
		</div>
@endif

<div class="row">
<div class="col-md-8 col-md-offset-2">
	<div class="col-sm-offset-2 col-sm-10">
		<h1>Add new photo</h1>
	</div>
	<form action="/photos" method="POST" class="form-horizontal">
	{{ csrf_field() }}
		<div class="form-group @if ($errors->has('photo')) has-error @endif">
			<label for="photo-input" class="col-sm-2 control-label">Photo:</label>
			<div class="col-sm-10">
				<input type="file" class="drag-and-drop" id="photo-input" name="photo">
				<div class="image-preview text-right" id="image-preview-container" style="display: none;">
					<img src="#" id="preview-image">
					<a href="javascript:void(0)" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Opcja dostępna wkrótce" disabled><i class="fa fa-crop" aria-hidden="true"></i> Crop</a>
					<a href="javascript:void(0)" onClick="clearPhotoInput()" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
				</div>
			</div>
		</div>
		<div class="form-group @if ($errors->has('title')) has-error @endif">
			<label for="title" class="col-sm-2 control-label">Title:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
			</div>
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			<label for="description" class="col-sm-2 control-label">Description:</label>
			<div class="col-sm-10">
				<textarea class="form-control" id="description" rows="3" placeholder="Description" name="description">{{ old('description') }}</textarea>
			</div>
		</div>
		<div class="form-group @if ($errors->has('tags')) has-error @endif">
			<label for="tags" class="col-sm-2 control-label">Tags:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="tags" placeholder="Tags" name="tags" value="{{ old('tags') }}">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-success">Add</button>
			</div>
		</div>
	</form>
</div>
</div>
</div>
@endsection