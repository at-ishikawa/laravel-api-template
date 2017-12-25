<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

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

Route::post('/users', 'User\UserCreateController@handle');
Route::group([
    'middleware' => 'auth:api',
], function (Router $router) {
    $router->get('/users/show', 'User\UserShowController@handle');
});
