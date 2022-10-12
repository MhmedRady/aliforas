<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
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

            'postal_code' => 'nullable|numeric',
            'address' => 'required|string',

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|numeric|min:11',

            "state_id" => "required",
            "city_id" => "required",

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('auth.FN_req'),
            'last_name.required' => __('auth.LN_req'),

            'phone.required' => __('auth.error_Emp',['var'=>__('auth.workPlace')]),
            "phone.numeric" => __("auth.error_Num",['var'=>__('auth.phoneNumber')]),
            'phone.min' => __('auth.contact_numberMin'),

            'address.required' => __('auth.error_Emp',['var'=>__('auth.address')]),
            'state_id.required' => __('auth.error_Emp',['var'=>__('auth.state')]),
            'city_id.required' => __('auth.error_Emp',['var'=>__('auth.city')]),

            "postal_code.numeric" => __("auth.error_Num",['var'=>__('auth.postal_code')]),
        ];
    }
}
