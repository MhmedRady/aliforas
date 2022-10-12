<?php

namespace App\Http\Requests;

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

        if (config('setting.pricing')){
            return [
                "email" => "required|email|unique:users,email",
                "Password" => "required|min:8",
                'confirm_password'=>'same:Password',
                "phone" => 'required|numeric|min:11',

//            "address" => "required|string",

//                "national_id" => "required|min:14|nullable|numeric",
//                "employer" => "required",
//                "gender" => "required",
//                "age" => "required|nullable|numeric",
            ];
        }else{
            return [
                "email" => "required|email|unique:users,email",
                "first_name" => "required|string",
                "last_name" => "required|string",
                "Password" => "required|min:8",
                'confirm_password'=>'same:Password',
                "phone" => 'required|numeric|min:11',

//            "address" => "required|string",

                "national_id" => "required|min:14|nullable|numeric",
                "employer" => "required",
                "gender" => "required",
                "age" => "required|nullable|numeric",
            ];
        }
    }

    public function messages()
    {
        return [
            "email.required" => __("auth.EmailReq"),
            "email.email" => __("auth.EmailErr"),
            "email.unique" => __("auth.emailExist"),
            "phone.numeric" => __("auth.error_Num",['var'=>__('auth.phoneNumber')]),

            "first_name.required" => __("auth.FN_req"),
            "last_name.required" => __("auth.LN_req"),
            "Password.required" => __("auth.error_Emp",['var'=>__('auth.password')]),
            "Password.min" => __("auth.passwordMin"),
            "confirm_password.same" => __("auth.notSamePW"),

            "national_id.required" => __("auth.error_Emp",['var'=>__('auth.NID')]),
            "national_id.min" => __("auth.national_idMin"),
            "national_id.numeric" => __("auth.error_Num",['var'=>__('auth.NID')]),

            "age.numeric" => __("auth.error_Num",['var'=>__('auth.age')]),

            'phone.min' => __('auth.contact_numberMin'),
            'phone.required' => __('auth.error_Emp',['var'=>__('auth.phoneNumber')]),
            'employer.required' => __('auth.error_Emp',['var'=>__('auth.workPlace')]),

        ];
    }
}
