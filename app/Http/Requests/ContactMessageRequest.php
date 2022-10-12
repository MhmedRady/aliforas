<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
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
            'name' => 'required|string|min:8',
            "email" => "required|email",
            "phone" => 'required|min:11|nullable|numeric',
            'message'=> 'required|string',
        ];
    }

    public function messages()
    {
        return [

            "name.required" => __('auth.error_Emp', ['var'=>__('auth.fullName')]),
            "email.required" => __("auth.EmailReq"),
            "email.email" => __("auth.EmailErr"),
            "email.unique" => __("auth.emailExist"),
            "phone.numeric" => __("auth.error_Num", ['var'=>__('auth.phoneNumber')]),

            'phone.min' => __('auth.contact_numberMin'),
            'phone.required' => __('auth.error_Emp', ['var'=>__('auth.phoneNumber')]),

            'message.required' => __('auth.error_Emp', ['var'=>__('layouts.message')]),
        ];
    }
}
