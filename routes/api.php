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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Requisited Routes
Route::get('/posts/{id}', 'Api\V1\PostsController@show');
// Route::get('/posts', 'Api\V1\PostsController@show');
// Route::post('/posts', 'Api\V1\PostsController@show');

Route::get('/user/{id}', 'Api\V1\UsersController@show');
Route::post('/user', 'Api\V1\UsersController@store');