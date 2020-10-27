<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthGrantType
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
        if ($request->grant_type != 'authorization_code') {
            return response()->json([
                'success' => false,
                'message' => 'bad_request'
            ], 400);
        }

        return $next($request);
    }
}
