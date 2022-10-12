<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'seller_id' => 'required|exists:users,id',
            'title' => 'nullable|string',
            'body' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('auth.error_Emp', ['var'=>__('layouts.msgTitle')]),
            'body.required' => __('auth.error_Emp', ['var'=>__('layouts.msgBody')]),
        ];
    }
}
