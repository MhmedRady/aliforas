<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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

//            'currentPW'=>'nullable|min:8',
//            'password'=>'nullable|min:8',
//            'confirm_password'=>'same:password',

            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'email' =>'required|email|unique:users,email,'.$this->id,
            'phone' =>'required|min:11|unique:users,phone,'.$this->id,
            'pickup_phone' =>'nullable|numeric|min:11',

            'store' =>'required|string',
            'city' =>'required|numeric',
            'state' =>'required|numeric',
            'address' =>'required|string',
            'street'=>'nullable|string',
            'build_number'=>'nullable|numeric',
            'postal_code'=>'nullable|numeric',

            'document_id'=>'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
//            'password.required' => __('auth.error_Emp',['var'=>__('auth.Password')]),
//            'password.min' => __('auth.passwordMin'),
//            'confirm_password.same' => __('auth.notSamePW'),

            'first_name.required' => __('auth.error_Emp', ['var'=>__('auth.fName')]),
            'last_name.required' => __('auth.error_Emp', ['var'=>__('auth.fName')]),
            'email.required' => __('auth.error_Emp', ['var'=>__('auth.Email')]),
            'phone.required' => __('auth.error_Emp', ['var'=>__('auth.phoneNumber')]),
            'store.required' => __('auth.error_Emp', ['var'=>__('seller.store')]),
            'city.required' => __('auth.error_Emp', ['var'=>__('auth.city')]),
            'state.required' => __('auth.error_Emp', ['var'=>__('auth.state')]),
            'address.required' => __('auth.error_Emp', ['var'=>__('auth.address')]),

            // 'phone.numeric' => __('auth.error_Num',['var'=>__('auth.phoneNumber')]),
            'pickup_phone.numeric' => __('auth.error_Num', ['var'=>__('seller.pickup_phone')]),
            'city.numeric' => __('auth.error_Num', ['var'=>__('auth.city')]),
            'state.numeric' => __('auth.error_Num', ['var'=>__('auth.state')]),
            'street.numeric' => __('auth.error_Num', ['var'=>__('auth.street')]),

            'build_number.numeric' => __('auth.error_Num', ['var'=>__('auth.build_number')]),
            'postal_code.numeric' => __('auth.error_Num', ['var'=>__('auth.postal_code')]),

            'document_id.numeric' => __('auth.error_Num', ['var'=>__('auth.NID')]),

            'email.email' => __('auth.EmailErr'),

            'email.unique' => __('auth.uniqueErr', ['var'=>__('auth.Email')]),
            'phone.unique' => __('auth.error_Num2', ['var'=>__('auth.phoneNumber')]),

        ];
    }
}
