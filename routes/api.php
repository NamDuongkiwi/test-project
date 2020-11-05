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





Route::get('class/{page}', 'Api\ClassController@getpage');
Route::post('enroll', 'Api\ClassController@enroll');

Route::post('import', 'Api\AdminController@importDataset');
