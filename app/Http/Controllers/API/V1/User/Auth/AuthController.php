<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Вход
     *
     * @bodyParam email string required Email . Example: admin@example.com
     * @bodyParam password string required Пароль .
     * @responseFile storage/responses/admin/login.json
     * @responseFile status=401 scenario="Login failed" storage/responses/admin/login-failed.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/admin/validation-failed.json
     * @param LoginRequest $request
     * @return SuccessResponse|ErrorResponse
     */
    public function login(LoginRequest $request): SuccessResponse|ErrorResponse
    {
        $user = $this->authService->login($request->toDTO());

        if ($user) {
            return new SuccessResponse([
                'user' => new LoginResource($user),
                'message' => 'Login success'
            ]);
        }

        return new ErrorResponse(
            message: 'Login failed',
            status: 401
        );
    }

    /**
     * Регистрация
     *
     * @param RegisterRequest $request
     * @return SuccessResponse
     */
    public function register(RegisterRequest $request): SuccessResponse
    {

        $user = $this->authService->register($request->toDTO());

        return new SuccessResponse
        ([
            'user' => new UserResource($user),
            'message' => 'Register success'
        ]);
    }


    /**
     * Выход
     *
     * @responseFile storage/responses/admin/logout.json
     * @authenticated
     * @param Request $request
     * @return SuccessEmptyResponse
     */
    public function logout(Request $request): SuccessEmptyResponse
    {
        $request->user()->tokens()->delete();

        return new SuccessEmptyResponse(
            message: 'Logout success'
        );
    }
}
