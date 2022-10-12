<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotProductResource extends JsonResource
{
    /**
     * Product Resource
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'product',
            'name'  =>  [
                'en'    =>  optional($this->translate('en'))->name,
                'ar'    =>  optional($this->translate('ar'))->name,
            ],
            'description'  =>  $this->description,
            'price'  =>  $this->price,
            'stock'  =>  $this->stock,
            'hot_price'  =>  $this->hot_price,
            'image_url'  =>  $this->image_url,
            'minimum_stock'  =>  $this->minimum_stock,
            'on_sale'  =>  $this->on_sale,
            'before_price'  =>  $this->before_price,
            'sold'  =>  $this->sold,
        ];
    }
}
