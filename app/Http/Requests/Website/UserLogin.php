<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class UserLogin extends FormRequest
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

    protected $redirectRoute = 'web.login';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "Email" => "required|email",
            "Password" => "required|min:8"
        ];
    }

    public function messages()
    {
        return [
            "Email.required" => __("auth.EmailReq"),
            "Email.email" => __("auth.EmailErr"),
            "Password.required" => __("auth.EmailReq"),
            "Password.min" => __("auth.passwordMin"),
        ];
    }
}
