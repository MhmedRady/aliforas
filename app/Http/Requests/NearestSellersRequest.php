<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NearestSellersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'seller'    => 'required|string',
            'lat'       => 'nullable|regex:/^[-]?\d+(\.\d+)+$/',
            'lng'       => 'nullable|regex:/^[-]?\d+(\.\d+)+$/',
            'distance'  => 'nullable|numeric|min:.1',
        ];
    }
}
