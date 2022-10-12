<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainSettingRequest extends FormRequest
{
    protected $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
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
        return
        [
            'email'=>'nullable|email',
            'phone'=>'nullable|min:11',
            'address'=>'nullable|string|min:5',
            'lat'=>'nullable|regex:/^[-]?\d+(\.\d+)+$/',
            'lng'=>'nullable||regex:/^[-]?\d+(\.\d+)+$/',
            'whatsapp'=>'nullable|min:11',
            'fax'=>'nullable|min:7',

            'facebook'=>'nullable|url',
            'twitter'=>'nullable|url',
            'instagram'=>'nullable|url',
        ];
    }
}
