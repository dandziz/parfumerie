<?php

namespace App\Http\Middleware;

use App\Models\Media;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RetrieveImageFromIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $imageId = $request->route('imageId');
        $image = Media::findOrFail($imageId);
        $request->merge(['image' => $image]);
        return $next($request);
    }
}
