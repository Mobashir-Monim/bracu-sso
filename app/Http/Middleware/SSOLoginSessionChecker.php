<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Helpers\SSOHelper;

class SSOLoginSessionChecker
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
        $val = (new SSOHelper)->authenticatorParamDecompressor(request()->val);
        
        if (property_exists($val, 'timestamp')) {
            if (!is_null($val->timestamp) && Carbon::parse($val->timestamp)->diffInSeconds(Carbon::now()) <= 30) {
                return $next($request);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'bad_request'
        ], 400);
    }
}
