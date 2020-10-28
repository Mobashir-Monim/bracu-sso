<?php

namespace App\Helpers;

use Auth;
use Carbon\Carbon;
use Larave\Passport\Passport;
use App\ResourceGroup;
use App\User;
use App\PToken;
use App\PClient;

class SSOHelper extends Helper
{
    private $varArr = [
        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "-", "_"
    ];

    public function authenticatorParamCompactor($data = null)
    {
        return $this->base64url_encode(json_encode([
            'client_id' => $data['client_id'],
            'scope' => $data['scope'],
            'state' => $data['state'],
            'nonce' => $data['nonce'],
            'redirect_uri' => $data['redirect_uri'],
            'timestamp' => $data['timestamp']
        ]));
    }

    public function authenticatorParamDecompressor($data)
    {
        return json_decode($this->base64url_decode($data));
    }

    public function authenticateCreds($request)
    {
        $credentials = request(['email', 'password']);
        return Auth::attempt($credentials);
    }

    public function generateRandID($checkingCont)
    {
        shuffle($this->varArr);
        $flag = true;

        while ($flag) {
            $code = '';

            while (strlen($code) < 100) {
                $code .= $this->varArr[rand(0, 63)];
            }

            $flag = !is_null($checkingCont->where('id', $code)->first());
        }

        return $code;
    }

    public function generateIDToken($auth_code, $access_token)
    {
        return [
            "iss" => url()->to('/'),
            "azp" => $access_token->client_id,
            "aud" => $access_token->client_id,
            "sub" => $access_token->user_id,
            "at_hash" => hash('sha256', $access_token->id),
            "iat" => Carbon::now()->timestamp,
            "exp" => Carbon::now()->timestamp + 604800,
            "nonce" => $auth_code->nonce,
        ];
    }

    public function convertToJWT($payload, $secret)
    {
        dd($this->base64url_encode(json_encode(`{"iss":"http://sso.eveneer.xyz","azp":"80473148-44a6-47f3-b446-ea014dfc4fea","aud":"80473148-44a6-47f3-b446-ea014dfc4fea","sub":"c86a03d6-cb30-44f0-b11a-346d8bcbc388","at_hash":"e6fad3c0fa7070e9352cd317954826fcf310f4eea1932f1e5c8b789f863f3cb7","iat":1603893226,"exp":1604498026,"nonce":null}`)));
        $header = $this->base64url_encode(json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT',
        ]));

        $payload = $this->base64url_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $header . '.' . $payload, $secret);

        return $header . '.' . $payload . '.' . $signature;
    }

    public function createAuthCode($val, $passportAuthCode)
    {
        return $passportAuthCode->create([
            'user_id' => auth()->user()->id,
            'client_id' => $val->client_id,
            'nonce' => $val->nonce,
            'scopes' => is_null($val->scope) ? null : json_encode(explode(' ', $val->scope)),
            'revoked' => false,
            'expires_at' => Carbon::now()->addSeconds(60)
        ]);
    }

    public function createAccessToken($user_id, $client_id, $scopes, $passportToken)
    {
        return $passportToken->create([
            'user_id' => $user_id,
            'client_id' => $client_id,
            'scopes' => $scopes,
            'name' => 'SSO login for ' . PClient::find($client_id)->name,
            'expires_at' => Carbon::now()->addSeconds(604800)->toDateTimeString(),
            'revoked' => false
        ]);
    }

    public function exchangeCodeToken($auth_code, $access_token)
    {
        $auth_code->revoked = true;
        $auth_code->save();
        dd($this->convertToJWT($this->generateIDToken($auth_code, $access_token), PClient::find($access_token->client_id)->secret), $this->generateIDToken($auth_code, $access_token));

        return [
            'access_token' => $access_token->id,
            'token_type' => 'Bearer',
            'expires_in' => 604800,
            'id_token' => $this->convertToJWT($this->generateIDToken($auth_code, $access_token), PClient::find($access_token->client_id)->secret),
        ];
    }

    public function getUserInfo($token)
    {
        $user = User::find($token->user_id);
        $scopes = json_decode($token->scopes);
        $user_info = ['sub' => $user->id];

        if (in_array('email', $scopes)) {
            $user_info['email'] = $user->email;
        }
        
        if (in_array('name', $scopes)) {
            $user_info['name'] = $user->name;
        }

        if (in_array('profile', $scopes)) {
            $user_info['email'] = $user->email;
            $user_info['name'] = $user->name;
        }

        // foreach ($scopes as $key => $scope) {
        //     if ($scope != 'openid') {
        //         // loop trough scope attributes
        //             // if !array_key_exists(attribute, $user_info)
        //                 // $user_info[attribute] = attribute value
        //     }
        // }

        return $user_info;
    }
}

// eyJpc3MiOiJodHRwOlwvXC9zc28uZXZlbmVlci54eXoiLCJhenAiOiI4MDQ3MzE0OC00NGE2LTQ3ZjMtYjQ0Ni1lYTAxNGRmYzRmZWEiLCJhdWQiOiI4MDQ3MzE0OC00NGE2LTQ3ZjMtYjQ0Ni1lYTAxNGRmYzRmZWEiLCJzdWIiOiJjODZhMDNkNi1jYjMwLTQ0ZjAtYjExYS0zNDZkOGJjYmMzODgiLCJhdF9oYXNoIjoiOGQyNWFlZDE0ZTEzM2RhZTIxZjk5ZjFhN2VhNzNiZTNjZDUwYWZiZGJmM2FmZGYyM2QyNDA0ZDE1MGE3NThjYiIsImlhdCI6MTYwMzg5MjIwMSwiZXhwIjoxNjA0NDk3MDAxLCJub25jZSI6bnVsbH0
// eyJpc3MiOiJodHRwOi8vc3NvLmV2ZW5lZXIueHl6IiwiYXpwIjoiODA0NzMxNDgtNDRhNi00N2YzLWI0NDYtZWEwMTRkZmM0ZmVhIiwiYXVkIjoiODA0NzMxNDgtNDRhNi00N2YzLWI0NDYtZWEwMTRkZmM0ZmVhIiwic3ViIjoiYzg2YTAzZDYtY2IzMC00NGYwLWIxMWEtMzQ2ZDhiY2JjMzg4IiwiYXRfaGFzaCI6IjhkMjVhZWQxNGUxMzNkYWUyMWY5OWYxYTdlYTczYmUzY2Q1MGFmYmRiZjNhZmRmMjNkMjQwNGQxNTBhNzU4Y2IiLCJpYXQiOjE2MDM4OTIyMDEsImV4cCI6MTYwNDQ5NzAwMSwibm9uY2UiOm51bGx9
// eyJpc3MiOiJodHRwOlwvXC9zc28uZXZlbmVlci54eXoiLCJhenAiOiI4MDQ3MzE0OC00NGE2LTQ3ZjMtYjQ0Ni1lYTAxNGRmYzRmZWEiLCJhdWQiOiI4MDQ3MzE0OC00NGE2LTQ3ZjMtYjQ0Ni1lYTAxNGRmYzRmZWEiLCJzdWIiOiJjODZhMDNkNi1jYjMwLTQ0ZjAtYjExYS0zNDZkOGJjYmMzODgiLCJhdF9oYXNoIjoiYTNkMzU4M2EwYWEyYmUwNzMxZDQzNDUzYzE1Y2Y3MjAwYjVjMmFiNTA3YTA2MGJhYzA4YmFiZGExNDJhOTMzZiIsImlhdCI6MTYwMzg5MzMyMiwiZXhwIjoxNjA0NDk4MTIyLCJub25jZSI6bnVsbH0