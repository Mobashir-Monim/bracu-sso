<?php

namespace App\Helpers;

use Carbon\Carbon;
use Larave\Passport\Passport;

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

    public function generateAuthCode($passportAuthCode)
    {
        shuffle($this->varArr);
        $flag = true;

        while ($flag) {
            $code = '';

            while (strlen($code) < 100) {
                $code .= $this->varArr[rand(0, 63)];
            }

            $flag = !is_null($passportAuthCode->where('id', $code)->first());
        }

        return $code;
    }

    public function createAuthCode($val, $passportAuthCode)
    {
        return $passportAuthCode->create([
            'id' => $this->generateAuthCode($passportAuthCode),
            'user_id' => auth()->user(),
            'client_id' => $val->client_id,
            'scopes' => is_null($val->scope) ? null : json_encode(explode(' ', $val->scope)),
            'revoked' => false,
            'expires_at' => Carbon::now()->addSeconds(60)
        ]);
    }



    // public static function createUserAccessToken($user)
    // {
    //     $tokenResult = $user->createToken('Personal Access Token');
    //     $token = $tokenResult->token;
    //     $token->save();

    //     return [
    //         'token' => $tokenResult->accessToken,
    //         'token_type' => 'Bearer',
    //         'expires_at' => Carbon::parse(
    //             $tokenResult->token->expires_at
    //         )->toDateTimeString(),
    //         'user' => ['name' => $user->name, 'email' => $user->email]
    //     ];
    // }
}