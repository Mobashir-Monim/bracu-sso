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

Route::get('/test', function () {
    $x = bin2hex(random_bytes(rand(30,50)));
    // To create UUID, use this:
    // dd(Str::uuid()->toString());
    dd(strlen($x), $x, strlen("18446744073709551615"));
});

Route::view('/{path?}', 'welcome');