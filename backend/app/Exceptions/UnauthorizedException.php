<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UnauthorizedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'status' => 401,
            'message' => 'Unauthenticated.'
        ], 401);
    }
}
