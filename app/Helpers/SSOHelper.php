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
        dd(PClient::find($client_id), $client_id);
        return $passportToken->create([
            'user_id' => $user_id,
            'client_id' => $client_id,
            'scopes' => $scopes,
            'name' => 'SSO login for ' . ResourceGroup::find($client_id)->name,
            'expires_at' => Carbon::now()->addSeconds(604800)->toDateTimeString(),
            'revoked' => false
        ]);
    }

    public function exchangeCodeToken($auth_code, $access_token)
    {
        $auth_code->revoked = true;
        $auth_code->save();

        return [
            'access_token' => $access_token->id,
            'token_type' => 'Bearer',
            'expires_in' => 604800,
            'id_token' => generateIDToken($access_token),
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