<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name.*'            => 'required',
            'description.*'     => 'required',
            'stock'             => 'gte:minimum_stock',
            'brand_id'          => 'required|exists:brands,id',
            'manufacturer_id'   => 'required|exists:manufacturers,id',
            'images.*'          => 'required|mimes:jpeg,PNG,JPG,JPEG,jpg,png|max:10000',
            'is_hot'            => 'nullable',
            'is_active'         => 'nullable',
            'return_allowed'    => 'nullable',
            'show_for'          => 'required|in:both,male,female',
            'return_duration'   => 'nullable|numeric',
            'price'             => 'required|numeric',
            'minimum_stock'     => 'nullable|numeric',
            'on_sale'           => 'nullable',
            'is_bundle'         => 'nullable',
            'before_price'      => 'nullable|numeric',
            'bundle_start'      => 'nullable',
            'bundle_end'        => 'nullable',
            'bundle_image'      => 'nullable',
            'sold'              => 'nullable',
            'hot_price'         => 'nullable|numeric',
            'seller_id'         => 'nullable|exists:users,id',
            'reward_points'     => 'nullable',
            'sale_ends_at'      => 'nullable',
            'barcode'           => 'nullable',
            'item_id'           => 'nullable',
            'axapta_code'       => 'nullable',
            'weight'            => 'nullable|numeric',
            'length'            => 'nullable|numeric',
            'width'             => 'nullable|numeric',
            'height'            => 'nullable|numeric',
            'combo_id'          => 'nullable',
            'category_id'       => 'nullable',
            'meta_title'        => 'nullable',
            'meta_description'  => 'nullable',
            'meta_keywords'     => 'nullable',
        ];
    }
}
