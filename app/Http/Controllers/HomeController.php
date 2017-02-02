<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = DB::table('photos')->inRandomOrder()->get();
        $data = array(
                'active' => 'random', 
                'title' => 'Random',
                'photos' => $photos
                );
        return view('home', $data);
    }

    public function newest()
    {
        $photos = DB::table('photos')->get();
        $data = array(
                'active' => 'newest', 
                'title' => 'Newest',
                'photos' => $photos
                );
            return view('home', $data);
    }

    public function popular()
    {
        $photos = DB::table('photos')->get();
        $data = array(
                'active' => 'popular', 
                'title' => 'Popular',
                'photos' => $photos
                );

            return view('home', $data);
    }

    public function topRated()
    {
        $photos = DB::table('photos')->get();
        $data = array(
                'active' => 'top-rated', 
                'title' => 'Top rated',
                'photos' => $photos
                );
            return view('home', $data);
    }
}
