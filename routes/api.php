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

Route::get('/oauth2/auth', 'SSOController@authenticator')->middleware(['sso-auth-param-checker', 'sso-client-checker']);
Route::get('/token', 'SSOController@exchangeCodeToken')->middleware(['sso-grant-type-checker', 'sso-client-checker', 'sso-verify-sp-cred', 'sso-verify-auth-code']);
Route::post('/token', 'SSOController@exchangeCodeToken')->middleware(['sso-grant-type-checker', 'sso-client-checker', 'sso-verify-sp-cred', 'sso-verify-auth-code']);
Route::get('/userinfo', 'SSOController@userInfo')->middleware(['access-token']);