<?php


namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserServices
{
    public function getCurrentUserInformation()
    {
            $user = Auth::user();
            return $user;

    }
}
