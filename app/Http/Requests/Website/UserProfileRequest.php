<?php

namespace App\Http\Requests\Website;

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
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'contact_number' => 'required|numeric|min:11',
            'postal_code' => 'nullable|numeric',
            'address' => 'required|string',
            'dob' => 'date_format:Y-m-d',
            "national_id" => "required|min:14|nullable|numeric",
            "employer" => "required",
            "gender" => "required",
            "age" => "required|nullable|numeric",
            'email' => "required|email|unique:users,email" . ($this->id ? ",$this->id,id" : ''),
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('auth.FN_req'),
            'last_name.required' => __('auth.LN_req'),
            'address.required' => __('auth.addressReq'),
            'contact_number.required' => __('auth.contact_numberReq'),
            'contact_number.min' => __('auth.contact_numberMin'),
            'postal_code.numeric' => __('auth.postalNum'),
            'email.required' => __('auth.EmailReq'),
            'email.unique' => __('auth.emailExist'),
            'dob.date_format' => __('auth.birthDate_date_format'),
        ];
    }
}
