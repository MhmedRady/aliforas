<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    // protected $redirectRoute = 'Login';

    public function rules()
    {

        $rules = [
//            'email' => 'nullable|email|exists:users,email',
//            'phone' => 'nullable|min:11|numeric|exists:users,phone',
            'password' => 'required|min:8'
        ];

        if ($this->request->has('phone'))
            $rules['phone'] = 'nullable|min:11|exists:users,phone';
        else
            $rules['email'] = 'required|email|exists:users,email';

        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }
}
