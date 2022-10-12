<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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

        $pricing = config('setting.pricing') === true;
        if ($pricing) {
            return [
                'name' => 'required|string',
//                'first_name' => 'required|string',
//                'last_name' => 'required|string',
                'phone' => 'required|numeric|min:11',
//            'postal_code' => 'nullable|numeric',
//            'address' => 'required|string',
                'dob' => 'date_format:Y-m-d|nullable',

                "gender" => "required",
                "user_image" => "nullable|mimes:jpeg,jpg,png|max:2048,",

//            "state_id" => "required",
//            "city_id" => "required",

                "age" => "nullable|numeric",
                'email' => "required|email|unique:users,email," . auth()->user()->id,
            ];
        }else{
            return [
                'name' => 'required|string',
//                'first_name' => 'required|string',
//                'last_name' => 'required|string',
                'phone' => 'required|numeric|min:11',
//            'postal_code' => 'nullable|numeric',
//            'address' => 'required|string',
                'dob' => 'date_format:Y-m-d|nullable',
                "national_id" => "required|min:14|nullable|numeric",
                "employer" => "required",
                "gender" => "required",
                "user_image" => "mimes:jpeg,jpg,png|max:2048,",

//            "state_id" => "required",
//            "city_id" => "required",

                "age" => "required|nullable|numeric",
                'email' => "required|email|unique:users,email," . auth()->user()->id,
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('auth.error_Emp',['var'=>__('auth.userName')]),
//            'first_name.required' => __('auth.FN_req'),
//            'last_name.required' => __('auth.LN_req'),

            'email.required' =>  __('auth.emailReq'),
            'email.unique' => __('auth.emailExist'),
            "email.email" => __("auth.EmailErr"),

            'dob.date_format' => __('auth.birthDate_date_format'),

            'user_image.mimes' => __('auth.imgErrorType'),
            'user_image.max' => __('auth.imageMax'),

            'phone.required' => __('auth.error_Emp',['var'=>__('auth.phoneNumber')]),
            "phone.numeric" => __("auth.error_Num",['var'=>__('auth.phoneNumber')]),
            'phone.min' => __('auth.contact_numberMin'),

            "national_id.min" => __("auth.national_idMin"),
            "national_id.numeric" => __("auth.error_Num",['var'=>__('auth.NID')]),

            "age.numeric" => __("auth.error_Num",['var'=>__('auth.age')]),

            'employer.required' => __('auth.error_Emp',['var'=>__('auth.workPlace')]),
        ];
    }
}
