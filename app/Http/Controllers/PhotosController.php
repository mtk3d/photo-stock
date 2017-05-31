<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use App\Ratings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Image; 

class PhotosController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['show', 'search']]);
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

		$name = md5(microtime());

		$path = $request->file('photo')->storeAs('public/images', $name.'.jpeg');
		$photo = new Photo;
		$photo->name = $name;
		$photo->title = $request->title;
		$photo->description = $request->description;
		$photo->tags = $request->tags;
		$photo->user_id = Auth::id();
		$photo->views = 0;
		$photo->save();

		$img = Image::make($request->file('photo')->getRealPath());
		$img->resize(600, null, function ($constraint) {
   			$constraint->aspectRatio();
		});
       	$img->save('storage/images/thumbnails/'.$name.'.jpeg');

		return redirect('photos')->with('success', 'Your photo has been uploaded!');
	}

	public function show($id)
	{
		$photo = Photo::where('id', $id)->first();
		$user = User::where('id', $photo->user_id)->first();
		$rating = Ratings::where('photo_id', $photo->id)->first();
		$data = array(
			'title' => 'Photo',
			'photo' => $photo,
			'user' => $user,
			'rating' => $rating
		);
		$photo->views += 1;
		$photo->save();

		return view('photo', $data);
	}

	public function destroy($id)
	{
		$photo = Photo::where('id', $id)->first();
		$photo->delete();
		return redirect('photos')->with('success', 'Your photo has been deleted!');
	}

	public function edit($id)
	{
		$photo = Photo::find($id);
		$data = array(
			'title' => 'Edit photo',
			'photo' => $photo
		);
		return view('edit-photo', $data);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
            		'title' => 'required|max:255',
            		'description' => 'required',
            		'tags' => 'required|max:255'
		]);
		$request->flash();

		$photo = Photo::where('id', $id)->first();
		$photo->title = $request->title;
		$photo->description = $request->description;
		$photo->tags = $request->tags;
		$photo->save();

		return redirect('photos')->with('success', 'Your photo has been updated!');
	}

	public function rate()
	{
		
	}

	/*public function search(Request $request)
	{
		$photos = Photo::all();
		$result = $photos->search($request->search);
		$data = array(
			'title' => 'Edit photo',
			'query' => $request->search,
			'photos' => $result
		);
		// return view('search', $data);
		return $photos;
	}*/
}
