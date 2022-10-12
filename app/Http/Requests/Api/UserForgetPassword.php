<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserForgetPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->request->has('phone'))
            $rules['phone'] = 'nullable|min:11|exists:users,phone';
        else
            $rules['email'] = 'required|email|exists:users,email';
        return $rules;
    }
}