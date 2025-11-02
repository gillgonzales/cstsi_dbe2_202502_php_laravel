<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExceptionJsonResponse extends Exception
{

    private int $httpStatus = 500;

    public function __construct(
        string $message,
        int $code = 500,
        Exception | null $previous = null,
        private string | null $statusCodeMsg = 'Erro no Servidor!'
        ){
            parent::__construct($message,$code,$previous);
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        $previous = $this->getPrevious();
        $httpStatus = $this->code >= 400 && $this->code <= 599 ? $this->code:$this->httpStatus;
        $error_message = ["erro" => $this->message];
        if (env('APP_DEBUG'))
            $error_message = [
                ...$error_message,
                "message" =>  $previous->getMessage(),
                "exception" =>  $previous,
                "trace" =>  $previous->getTrace()
            ];
        $response = response()->json($error_message, $httpStatus);
        if ($this->statusCodeMsg)
            return $response->setStatusCode($httpStatus, $this->statusCodeMsg);
        return $response;
    }

    public function report():void {
        report($this->getPrevious());
        Log::error("Lançanda a Exceção ExcepetionJsonResponse!!");
        Log::channel('stderr')->error("Lançanda a Exceção ExcepetionJsonResponse!!");
    }
}
