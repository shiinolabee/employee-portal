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

Route::post('auth/login', 'Auth\AuthController@login');
Route::post('auth/register', 'Auth\AuthController@register');
Route::post('auth/google', 'Auth\AuthController@google');
Route::post('auth/unlink', 'Auth\AuthController@unlink');

Route::post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
Route::get('auth/password/verify', 'Auth\PasswordResetController@verify');
Route::post('auth/password/reset', 'Auth\PasswordResetController@reset');


//protected API routes with JWT (must be logged in)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'api'], function () {
	Route::group(['prefix' => 'clock'], function(){
	    Route::get('in', 'TimeLogController@clockIn');
	    Route::get('out', 'TimeLogController@clockOut');
	    Route::get('status', 'TimeLogController@timeLogStatus');
	});
	Route::group(['prefix' => 'break'], function(){
	    Route::get('in', 'TimeLogController@breakIn');
	    Route::get('out', 'TimeLogController@breakOut');
	});
});
