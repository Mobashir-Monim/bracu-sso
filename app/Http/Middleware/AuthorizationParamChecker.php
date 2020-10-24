<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizationParamChecker
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
        if ($request->client_id == null || $request->redirect_uri == null ||
            $request->response_type == null || $request->scope == null) {
            return response()->json([
                'success' => false,
            ], 400);
        }
        
        return $next($request);
    }
}
