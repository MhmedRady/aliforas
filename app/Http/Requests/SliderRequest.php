<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'title.*'=> 'nullable|string|min:5|max:20',
            'sub_title.*'=> 'nullable|string|min:5|max:20',
            'description.*'=> 'nullable|string|min:5|max:100',
            'product_id'=> 'nullable',

            'image'=>  (request()->isMethod('put') ? '' : 'required|'). "image|mimes:jpeg,jpg,png|max:4096",
        ];
    }
//must be at least 10 characters.
    public function messages()
    {
        return [
            'title.*.min' => __('auth.error_min', ['var'=>__('auth.title'), 'num'=>5, 'more' => __('auth.or_more')]),
            'sub_title.*.min' => __('auth.error_min', ['var'=>__('auth.subTitle'), 'num'=>5, 'more' => __('auth.or_more')]),

            'title.*.max' => __('auth.error_max', ['var' => __('auth.title'), 'num' => 20]),
            'sub_title.*.max' => __('auth.error_max', ['var' => __('auth.subTitle'), 'num' => 20]),

            'description.*.min' => __('auth.error_min', ['var' => __('auth.title'), 'num' => 5, 'more' => __('auth.or_more')]),
            'description.*.max' => __('auth.error_max', ['var' => __('auth.title'), 'num' => 100]),
        ];
    }
}
