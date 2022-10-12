<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Models\UserAddress;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCheckoutRequest extends FormRequest
{
    protected $redirectRoute = 'cart.checkout';
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
        if (request()->post('branch_id') && !is_null(request()->post('branch_id'))){
           return ['branch_id' => ['required', Rule::exists(Branch::class, 'id')]];
        }else{
            return request()->has('user_address_id') ? [
                'user_address_id' => ['required', Rule::exists(UserAddress::class, 'id')->where('user_id', auth()->id())]
            ] : [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|numeric|min:11',
                'postal_code' => 'nullable|numeric',
                'address' => 'required|string',
                'state_id' => 'required',
                'city_id' => 'required',
            ];
        }
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
            'email.required' => __('auth.emailReq'),
            'city_id.required' => __('auth.cityReq'),
            'state_id.required' => __('auth.stateReq'),
            'email.unique' => __('auth.emailExist'),

        ];
    }
}
