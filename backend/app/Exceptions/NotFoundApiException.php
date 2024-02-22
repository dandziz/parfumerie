<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundApiException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => 'Không tìm thấy dữ liệu.'
        ], 404);
    }
}
