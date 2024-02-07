<?php

namespace App\Http\Middleware;

use App\Exceptions\EmailHasNotBeenVerifiedException;
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
     * @throws EmailHasNotBeenVerifiedException
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user('api')->email_verified_at) {
            throw new EmailHasNotBeenVerifiedException();
        }

        return $next($request);
    }
}
