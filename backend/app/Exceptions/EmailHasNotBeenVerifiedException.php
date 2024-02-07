<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class EmailHasNotBeenVerifiedException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => __('messages.emailNotVerified'),
            'status' => false,
        ], 403);
    }
}
