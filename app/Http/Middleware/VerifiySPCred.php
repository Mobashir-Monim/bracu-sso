<?php

namespace App\Http\Middleware;

use Closure;

class VerifiySPCred
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
        $client = Passport::client()->find($request->client_id);

        if ($client->secret != $request->client_secret || $client->redirect_uri != $request->redirect_uri) {
            return response()->json([
                'success' => false,
            ], 401);
        }
        
        return $next($request);
    }
}
