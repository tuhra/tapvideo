<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Helpers\MptHelper;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API'], function() {
	// Route::post('checkMsisdn', 'AppController@checkMsisdn');
	// Route::post('subscribe', 'AppController@subscribe');
	// Route::post('otpResent', 'AppController@otpResent');
	// Route::post('otpValidation', 'AppController@otpValidation');
	// Route::post('checkInsufficient', 'AppController@checkInsufficient');
	// Route::post('postXml', 'AppController@xmlToJson');
	// //Route::post('unsubscribe', 'AppController@unsubscribe');
	// Route::get('categories', 'AppController@categories');
	// Route::post('favourite', 'AppController@postFavourite');
	// Route::get('favourite/{msisdn}', 'AppController@favourite');
	// Route::post('favourite/{id}/delete', 'AppController@deleteFavourite');
	// Route::post('checkFavourite', 'AppController@checkFavourite');
	// Route::get('faq', 'AppController@faq');
	// Route::get('term-and-condition', 'AppController@tandc');
	// Route::post('help', 'AppController@help');
	// Route::get('about', 'AppController@about');
	// Route::post('checkSubscriber', 'AppController@checkSubscriber');;
	// Route::get('getDownloadlink', 'AppController@getDownloadLink');

	// Route::get('getHE', function () {
	// 	$helper = new MptHelper;
	// 	$response = array();
	// 	$response['url'] = $helper->mptHe();
	// 	return json_encode($response);
	// });
	 Route::get('categories', 'CategoryController@categories');
	 Route::get('{category_id}/videos', 'VideoController@getVideo');

});
