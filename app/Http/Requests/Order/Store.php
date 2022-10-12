<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function rules()
    {
        return [
            'carteProducts' => 'required|array|min:1',
            'country' => 'required|numeric',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'postal_code' => 'required|numeric',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'payment_type' => 'required|string'
        ];
    }
}
