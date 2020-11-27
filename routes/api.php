<?php
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
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::get('user', 'Api\UserController@user');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', 'Api\UserController@details');
});


Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});


/* Route::get('class/{page}', 'Api\ClassController@getpage');

Route::post('test', 'Api\ClassController@test');
 */
Route::get('class/{page}', 'Api\ClassController@getpage');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('test', 'Api\ClassController@test');
    Route::post('enroll', 'Api\ClassController@enroll');
    Route::post('delete', 'Api\ClassController@deleteclass');
    Route::get('show', 'Api\ClassController@show');
});



