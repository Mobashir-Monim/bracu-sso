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
"teG3wvigoU_KPbPAiEVERFmlGeHWPsnqbEk1pAhz69B0kGHJXU8l8tPHpTw0Gy_M9BJ5WAe9FvXL41xSFbqMGiJ7DIZ32ejlncrf2vGkMl26C5p8OOvuS6ThFjREUzWbV0sYtJL0nNjzmQNCQeb90tDQDZW229ZeUNlM2yN0QRisKlGFSK7uL8X0dRUbXnfgS6eI4mvSAK6tqq3n8IcPA0PxBr-R81rtdG70C2zxlPQ4Wp_MJzjb81d-RPdcYd64loOMhhHFbbfq2bTS9TSn_Y16lYA7gyRGSPhwcsdqOH2qqon7QOiF8gtrvztwd9TpxecPd7mleGGWVFlN6pTQYQ";
Route::get('/test', function () {
    $var = [
        "alg" => "HS256",
        "typ" => "JWT"
    ];

    dd(base64_encode(json_encode($var)));

    $str = "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAwRYOFyBC/N65AlS5z4zc
    WZ+5qmQrvslqbuPLriToeHEqa45BGvs4ykYF5w/SEZLeSIGZhonVhUPdI1375sZA
    yh/RUaat4uO44hjiq81MSPttJI/ew/EeakmVLoDS1OD09YftRsFrLyuYtA36Z6M4
    kAJZx/KWtw89Xyeepg+ZTpjdUcviCftzuzsCZTxZAJ6MjDbKU8arYDa5MPTAAp3J
    wCRAvyoQkyIVp6fH0yIp/5slkBmZwtzGzdA6tqhbzdilDl8zyFlz5DsJSC+CvXV6
    JOTLuBkVKELVj9LRD5PfpOZUUGOqDpTFjIAmFc7dDg0OiHB/8l08AYTAYgJy/F3B
    OcnHiAj+gtA0mf+ajGBiY1DI2CziQ6qGjurUgUGPLYtxPf06YoLvy/mqDpingrWm
    kHqRBjXH49Kly3ICHVmO5i/CqegdB5Puxmi7vsr+w+m1V6bzq74Er+5XUv1tBPK7
    MftkxrSKpqpqDBawoUob8Xb29JCSQnBSNJF8kdpf8U8ttzi0QCJPjC+SKOnTCjnI
    8+/JaerCLIAeQKC7rFL/iAJYJjGEBlWt8Hx5CS74dTbRmi8F9PBIFZv9f/dvHHZH
    IUhKCf1gHrF7TiSLLTNYBUdZI5RqlFdGruVVtvZnQjhlXlOo/aGVP7wvPWTU2e04
    ZswiC8acTEK/HvrhaGFbRMsCAwEAAQ==";
    $decodedHex = bin2hex(base64_decode($str));
    $formatted = "";

    for ($i = 0; $i < strlen($decodedHex); $i++) {
        if (($i + 1) % 32 == 0 && $i != 0) {
            $formatted .= $decodedHex[$i] . "\n";
        } elseif (($i + 1) % 16 == 0 && $i != 0) {
            $formatted .= $decodedHex[$i] . "  ";
        } elseif (($i + 1) % 2 == 0 && $i != 0) {
            $formatted .= $decodedHex[$i] . " ";
        } else {
            $formatted .= $decodedHex[$i];
        }
    }

    dd($formatted);

    dd(Laravel\Passport\Passport::client()->all());

    $x = bin2hex(random_bytes(rand(30,50)));
    // To create UUID, use this:
    // dd(Str::uuid()->toString());
    dd(strlen($x), $x, strlen("18446744073709551615"));
});

Route::view('/{path?}', 'welcome');