<?php

namespace App\Services;

use App\Http\DTOs\LoginDTO;
use App\Http\DTOs\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Object_;

class AuthService
{
    public function register(RegisterDTO $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
        return $user;
    }

    public function login(LoginDTO $data): ?array
    {
        if (Auth::attempt(['email' => $data->email, 'password' => $data->password], true)) {
            $user = Auth::user();
            $token = $user->createToken("API TOKEN")->plainTextToken;

            return [
                'user' => $user,
                'access_token' => $token,
            ];
        }

        return null;
    }
    public function logoutUser()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        Auth::logout();
    }
}







