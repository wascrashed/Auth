<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Responses\SuccessResponse;
use App\Services\UserServices;

class UserController extends Controller
{
    public function __construct(private UserServices $userService)
    {
    }

    public function show()
    {
        $data = $this->userService->getCurrentUserInformation();

        return new SuccessResponse([
            'data' => new UserResource($data),
            'message' => 'User info'
        ]);
    }

}

