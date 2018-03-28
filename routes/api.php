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

Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');
Route::post('social_auth', 'Api\Auth\SocialAuthController@socialAuth');

Route::middleware('auth:api')->group(function () {

    Route::post('logout', 'Api\Auth\LoginController@logout');
    Route::get('users/{user}/follow', 'Api\UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'Api\UserController@unfollow')->name('unfollow');

    Route::get('locations', 'Api\LocationController@index');
    Route::post('add_location', 'Api\LocationController@addLocation');
    Route::get('get_location/{id}', 'Api\LocationController@getLocation');



    Route::get('/notifications', 'LocationController@notifications');
});