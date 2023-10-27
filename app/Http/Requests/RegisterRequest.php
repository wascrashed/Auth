<?php

namespace App\Http\Requests;

use App\Http\DTOs\RegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return !auth()->check();
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|',
        ];
    }
    public function toDTO(): RegisterDTO
    {
        return new RegisterDTO(
            $this->input('name'),
            $this->input('email'),
            $this->input('password')
        );
    }

}
