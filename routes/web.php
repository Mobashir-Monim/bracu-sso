<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get();

Route::get('/test', function () {
    // $var = [
    //     "alg" => "HS256",
    //     "typ" => "JWT"
    // ];

    // dd(base64_encode(json_encode($var)));
    // dd(exec('cd ../storage & ls -l'));
    $key = file_get_contents("../storage/oauth-private.key");
    $data = openssl_pkey_get_private($key);
    $data = openssl_pkey_get_details($data);

    $key = $data['key'];
    $modulus = $data['rsa']['n'];
    $exponent = $data['rsa']['e'];
    dd($key, base64_encode($modulus), base64_encode(($exponent)));
});

Route::get('t', function () {
    return view('sso.login');
});
Route::post('/oauth2/v2/auth', 'SSOController@authenticate')->name('sso-authenticate');
Route::view('/{path?}', 'welcome');