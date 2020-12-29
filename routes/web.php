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
Route::group(['namespace' => 'Frontend'], function() {
	// Route::group(['middleware' => ['myid']], function() {
		Route::get('/', 'WelcomeController@index')->name('frontend.index');
});
	

Route::group(['prefix'=>'admin'],function(){
	Route::get('/', function () {
		return redirect('admin/login');
	});
	Auth::routes();

	Route::group(['namespace' => 'Backend'],function(){

		Route::resource('category', 'CategoryController');
		Route::resource('video', 'VideoController');
		Route::get('import', 'ImportVideoController@index');
		Route::post('import/store', 'ImportVideoController@store');
		Route::delete('media/{id}', 'MediaController@destroy');
	});
});