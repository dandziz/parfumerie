<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiEmailIsVerified
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
        if (!$request->user('api')->email_verified_at) {
            return response()->json([
                'status' => 403,
                'messages' => 'Your email has not yet been verified.'
            ], 403);
        }

        return $next($request);
    }
}
