<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class SuccessEmptyResponse extends JsonResponse
{
    public function __construct($message = null, $status = 204, $headers = [], $options = 0)
    {
        parent::__construct(null, $status, $headers, $options);

        if ($message) {
            $this->setData(['message' => $message]);
        }
    }

    public static function withMessage($message, $status = 204, $headers = [], $options = 0)
    {
        return new self($message, $status, $headers, $options);
    }
}
