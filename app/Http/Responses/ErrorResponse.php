<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct($message = null, $status = 400, $headers = [], $options = 0)
    {
        parent::__construct(['error' => $message], $status, $headers, $options);
    }

    public static function withMessage($message, $status = 400, $headers = [], $options = 0)
    {
        return new self($message, $status, $headers, $options);
    }
}
