<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Brand Resource
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'brand',
            'name'  =>  [
                'en'    =>  optional($this->translate('en'))->name,
                'ar'    =>  optional($this->translate('ar'))->name,
            ],
            'logo'  =>  $this->logo_url,
            'code'  =>  $this->code,
        ];
    }
}
