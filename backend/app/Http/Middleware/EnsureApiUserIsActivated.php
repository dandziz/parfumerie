<?php

namespace App\Http\Middleware;

use App\Exceptions\UserIsNotActivated;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiUserIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws UserIsNotActivated
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user('api')->status == 0) {
            throw new UserIsNotActivated();
        }

        return $next($request);
    }
}
