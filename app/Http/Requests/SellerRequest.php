<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordValidation;

class SellerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = [
            'name' => 'required|string',

            'account_legal_file' => 'image|mimes:jpg,jpeg,png',
            'contact_number' => 'required|numeric|unique:users,contact_number',

            'password' => ['required', 'confirmed', new PasswordValidation],
            // 'document_id'=>'required',
            'document_first_name' => 'required',
            'document_last_name' => 'required',
            /* 'document_expiry_date'=>'required', */
            // 'pickup_city'=>'required',
            // 'pickup_street'=>'required',
            'pickup_contact_number' => 'required',
            /* 'pickup_building_number'=>'required', */
            /* 'pickup_building_number'=>'required', */
            'store_name' => 'required',
            /* 'account_legal_type'=>'required', */

            'address' => 'required|string',
            // 'lat'=>'required',
            // 'lng'=>'required'
        ];

        if (request()->email) {
            $return["email"] = 'unique:users,email';
        }

        return $return;
    }
}
