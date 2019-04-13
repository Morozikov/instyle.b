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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->get('users', 'Api\UserController@index');
Route::middleware('auth:api')->get('users/{user}', 'Api\UserController@show');
Route::post('users', 'Api\UserController@store');
Route::post('users/auth', 'Api\UserController@auth');
Route::middleware('auth:api')->put('users', 'Api\UserController@update');
Route::middleware('auth:api')->delete('users', 'Api\UserController@delete');