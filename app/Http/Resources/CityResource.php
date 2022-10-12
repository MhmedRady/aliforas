<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'name'  =>  [
                'en'    =>  optional($this->translate('en'))->name,
                'ar'    =>  optional($this->translate('ar'))->name,
            ],
        ];
    }
}
