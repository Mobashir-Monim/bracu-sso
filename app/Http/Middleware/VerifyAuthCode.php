<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Passport;

class VerifyAuthCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authCode = Passport::authCode()->find(request()->code);

        if (is_null($authCode)) {
            return response()->json([
                'success' => false,
            ], 401);
        }

        if ($authCode->client_id != $request->client_id) {
            return response()->json([
                'success' => false,
            ], 401);
        }

        return $next($request);
    }
}
