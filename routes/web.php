<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('home', ['title'=>'Home', 'active' => 'random']);
});*/

Route::get('/', function () {
    return redirect('/random');
});
Route::get('/random', 'HomeController@index');
Route::get('/newest', 'HomeController@newest');
Route::get('/popular', 'HomeController@popular');
Route::get('/top-rated', 'HomeController@topRated');
Route::resource('/photos', 'PhotosController');

Route::get('/search', 'PhotosController@search');

Auth::routes();
// Route::get('/home', function () {
//     return view('front');
// });