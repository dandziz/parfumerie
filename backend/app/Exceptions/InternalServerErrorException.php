<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class InternalServerErrorException extends Exception
{
    public function render($request): JsonResponse
    {
        Log::error('Error 500: ' . $this->getMessage());
        return response()->json([
            'message' => __('messages.internalServerError'),
            'status' => false,
        ], 500);
    }
}
