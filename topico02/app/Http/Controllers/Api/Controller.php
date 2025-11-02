<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionJsonResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Controller
{

    protected function errorHandler(
        string $message,
        Exception $exception,
        int $httpStatus = 500,
        string | null $statusCodeMsg = null
        ): JsonResponse
    {
      throw new ExceptionJsonResponse($message,$httpStatus,$exception);
    }
}
