<?php

namespace App\Helpers;

use Carbon\Carbon;

class SSOHelper extends Helper
{
    public static function authenticatorParamCompactor($request)
    {
        $val = [
            'scope' => $request->scope,
            'state' => $request->state,
            'nonce' => $request->nonce,
            'redirect_uri' => $request->redirect_uri,
            'timestamp' => $request->timestamp,
        ];
    }
}