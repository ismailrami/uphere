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

    Route::get('message', 'Api\MessageController@index');

    Route::post('createmessage', 'Api\MessageController@create');

    Route::get('locations', 'Api\LocationController@index');

    Route::get('relations', 'Api\RelationController@index');
    Route::post('add_relation', 'Api\RelationController@create');
    Route::post('delete_relation', 'Api\RelationController@delete');
});