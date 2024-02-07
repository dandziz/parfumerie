<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserIsNotActivatedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => __('messages.userIsNotActivated'),
            'status' => false,
        ], 401);
    }
}
