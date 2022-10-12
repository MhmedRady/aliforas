<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        return [
            'new_password'=>'required|min:8',
            'confirm_password'=>'same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => __("auth.error_Emp",['var'=>__('auth.password')]),

            'min'=>__('auth.passwordMin'),
            'same'=>__('auth.notSamePW')
        ];
    }
}
