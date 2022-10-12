<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordValidation;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
//            'first_name' => 'required|string',
//            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone|min:11',
//            'password' => ['required', new PasswordValidation],
            'password' => 'required|string|min:4',
        ];
    }
}
