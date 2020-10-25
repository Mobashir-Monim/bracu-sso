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

        return redirect($val['redirect_uri'] . '?state=' . $val['state'] . '&code=' . $helper->createAuthCode($val, Passport::authCode()));
    }
}
