<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::get('/rgs', 'ResourceGroupController@index');
Route::get('/oauth2/auth', 'SSOController@authenticator');
Route::get('/token', 'SSOController@exchangeCodeToken');
Route::post('/token', 'SSOController@exchangeCodeToken');
Route::get('/userinfo', 'SSOController@exchangeCodeToken');