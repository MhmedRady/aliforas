<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            "email" => "required|email|unique:users,email",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "password" => "required|min:8",

            "address" => "required|string",
            "national_id" => "required|min:14|nullable|numeric",
            "employer" => "required",
            "gender" => "required",
            "age" => "required|nullable|numeric",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => __("auth.EmailReq"),
            "email.email" => __("auth.EmailErr"),
            "first_name.required" => __("auth.FN_req"),
            "last_name.required" => __("auth.LN_req"),
            "Password.required" => __("auth.EmailReq"),
            "Password.min" => __("auth.passwordMin"),
        ];
    }
}
