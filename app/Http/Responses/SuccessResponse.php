<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class SuccessResponse extends JsonResponse
{
    public function __construct($data = null, $status = 200, $headers = [], $options = 0)
    {
        parent::__construct(['data' => $data], $status, $headers, $options);
    }

    public static function withMessage($message, $status = 200, $headers = [], $options = 0)
    {
        return new self(['message' => $message], $status, $headers, $options);
    }
}
