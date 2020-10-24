<?php

namespace App\Http\Middleware;

use Closure;

class RedirectURIChecker
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
        if (Laravel\Passport\Passport::client()->where('id', $request->client_id)->first()->redirect != $request->redirect_uri) {
            return response()->json([
                'success' => false,
            ], 401);
        }

        return $next($request);
    }
}
