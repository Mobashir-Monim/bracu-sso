<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Passport;

class ClientChecker
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
        if (Passport::client()->where('id', $request->client_id)->first() != null) {
            return response()->json([
                'success' => false,
            ], 401);
        }

        return $next($request);
    }
}
