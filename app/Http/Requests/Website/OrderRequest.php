<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'phone' => 'required|numeric|min:11',
            'postal_code' => 'nullable|numeric',
            'address' => 'required|string',

            'email' => "required|email|unique:users,email" . ($this->id ? ",$this->id" : ''),

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('auth.FN_req'),
            'last_name.required' => __('auth.LN_req'),
            'address.required' => __('auth.addressReq'),
            'phone.required' => __('auth.contact_numberReq'),
            'phone.min' => __('auth.contact_numberMin'),
            'postal_code.numeric' => __('auth.postalNum'),
            'email.required' => __('auth.EmailReq'),
            'email.unique' => __('auth.emailExist')
        ];
    }
}
