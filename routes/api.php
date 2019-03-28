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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
  $api->group([
    'prefix' => '/v1',
    'namespace' => '\App\Http\Controllers\Api\V1'], function ($api) {
      
      $api->get('/posts', 'PostsController@index');
      $api->get('/posts/{id}', 'PostsController@show');
      $api->post('/posts', 'PostsController@store');
  });
});