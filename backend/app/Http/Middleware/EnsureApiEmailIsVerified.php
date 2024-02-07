<?php

namespace App\Http\Middleware;

use App\Exceptions\UserIsNotActivated;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws UserIsNotActivated
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user('api')->email_verified_at) {
            throw new UserIsNotActivated();
        }

        return $next($request);
    }
}
