<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['show']]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$photos = Photo::where('user_id', Auth::user()->id)->get();
        	$data = array(
              	'title' => 'Photos',
              	'photos' => $photos
              );
            return view('photos', $data);
	}

	public function create()
	{
		$data = array(
			'title' => 'Add photo'
		);
		return view('add-photo', $data);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
   			'photo' => 'required',
            		'title' => 'required|max:255',
            		'description' => 'required',
            		'tags' => 'required|max:255'
		]);
		$request->flash();
		$photo = new Photo;
		$photo->name = md5(uniqid(rand(), true));
		$photo->title = $request->title;
		$photo->description = $request->description;
		$photo->description = $request->description;
		$photo->tags = $request->tags;
		$photo->user_id = Auth::id();
		$photo->save();

		return redirect('photos')->with('success', 'Your photo has been uploaded!');
	}

	public function show($id)
	{
		$photo = Photo::where('id', $id)->first();
		$user = User::where('id', $photo->user_id)->first();
		$data = array(
			'title' => 'Photo',
			'photo' => $photo,
			'user' => $user
		);
		return view('photo', $data);
	}

	public function destroy($id)
	{
		$photo = Photo::where('id', $id)->first();
		$photo->delete();
		return redirect('photos')->with('success', 'Your photo has been deleted!');
	}

}