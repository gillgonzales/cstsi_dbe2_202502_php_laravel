<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Controller
{

    protected function errorHandler(string $message, Exception $exception, int $httpStatus = 500, string | null $statusCodeMsg = null): JsonResponse
    {
        $error_message = ["erro" => $message];
        if (env('APP_DEBUG'))
            $error_message = [
                ...$error_message,
                "message" => $exception->getMessage(),
                "exception" => $exception,
                "trace" => $exception->getTrace()
            ];
        $response = response()->json($error_message,$httpStatus);
        if($statusCodeMsg)
            return $response->setStatusCode($httpStatus,$statusCodeMsg);
        return $response;
    }
}
