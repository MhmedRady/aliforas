<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Brand Resource
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $name = (request()->hasHeader('accept-language') && request()->header('accept-language') == 'ar-EG')? optional($this->translate('ar'))->name : optional($this->translate('en'))->name;
        return [
            'id'    =>  $this->id,
            // 'type'  =>  'category',
            'name'  =>  $name,
            // 'code'  =>  $this->code,
            // 'body'  =>  $this->body,
            // 'in_header'  =>  $this->in_header,
            'icon_url'  =>  $this->icon_url,
            'banner_url'  =>  $this->banner_url,
            'products'  =>  FilteredProductResource::collection($this->products),
            'parent' => $this->parent ? $this->parent->only(['id', 'parent_id', 'icon', 'banner', 'name']) : null,
        ];
    }
}
