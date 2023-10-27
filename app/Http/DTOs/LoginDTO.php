<?php

namespace App\Http\DTOs;

class LoginDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
