<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidCredentialException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => __('messages.invalidCredentials'),
            'status' => false,
        ], 401);
    }
}
