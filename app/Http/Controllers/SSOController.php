<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Helpers\SSOHelper;
use App\Http\Requests\SSOLoginRequest as SLR;
use Laravel\Passport\Passport;

class SSOController extends Controller
{
    public function authenticator()
    {
        return redirect(route('sso-login', ['val' => (new SSOHelper)->authenticatorParamCompactor([
            'client_id' => request()->client_id,
            'scope' => request()->scope,
            'state' => request()->state,
            'nonce' => request()->nonce,
            'redirect_uri' => request()->redirect_uri,
            'timestamp' => Carbon::now()->timestamp,
        ])]));
    }

    public function ssoLogin($val)
    {
        return view('sso/login', compact('val'));
    }

    public function authenticate(SLR $request)
    {
        $helper = new SSOHelper;
        $val = $helper->authenticatorParamDecompressor($request->stuff);

        return redirect($val['redirect_uri'] . '?state=' . $val['state'] . '&code=' . $helper->createAuthCode($val, Passport::authCode()) . '&scope=' . $val->scope);
    }

    public function exchangeCodeToken()
    {
        $helper = new SSOHelper;
        $auth_code = Passport::authCode()->find(request()->code);
        $access_token = $helper->createAccessToken($auth_code->user_id, $auth_code->client_id, $auth_code->scopes, Passport::token());

        return response()->json($helper->exchangeCodeToken($auth_code, $access_token));
    }

    public function discoveryDoc()
    {
        return response()->json([
            'issuer' => url()->to('/'),
            'authorization_endpoint' => url()->to('/') . '/oauth/authorize',
            'token_endpoint' => url()->to('/') . '/oauth/token',
            'userinfo_endpoint' => url()->to('/') . '/oauth',
            'jwks_uri' => url()->to('/') . '/oauth2/certs',
            'scopes_supported' => url()->to('/'),
            'response_types_supported' => [
                'code',
                // 'id_token',
                // 'token id_token'
            ],
            'token_endpoint_auth_methods_supported' => [
                'client_secret_basic',
                'client_secret_post'
            ],
        ]);
    }

    public function jwksDoc()
    {
        $key = file_get_contents("../storage/oauth-private.key");
        $data = openssl_pkey_get_private($key);
        $data = openssl_pkey_get_details($data);

        return response()->json([
            "keys" => [
                [
                    // "kid" => "178ab1dc5913d929d37c23dcaa961872f8d70b68",
                    "kty" => "RSA",
                    "n" => (new SSOHelper)->base64url_encode($data['rsa']['n']),
                    "e" => (new SSOHelper)->base64url_encode($data['rsa']['e']),
                    "use" => "sig",
                    "alg" => "RS256"
                ],
              ]
        ]);
    }
}
