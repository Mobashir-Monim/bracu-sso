<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Passport;

class VerifyAccessToken
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
        $token = Passport::token()->find($request->bearerToken());

        if (is_null($token)) {
            return response()->json([
                'success' => false,
            ], 401);
        }

        if ($token->revoked || Carbon\Carbon::now() > Carbon\Carbon::parse($token->expires_at)) {
            return response()->json([
                'success' => false,
            ], 401);
        }

        return $next($request);
    }
}
