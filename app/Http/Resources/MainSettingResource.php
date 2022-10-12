<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainSettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'taxes'      =>  $this->taxes??0,
            'address'    =>  $this->address??null,
            'lat'        =>  $this->lat??null,
            'lng'        =>  $this->lng??null,
            'email'      =>  $this->email??null,
            'phone'      =>  $this->phone??null,
            'whatsapp'   =>  $this->whatsapp??null,
            'facebook'   =>  $this->facebook??null,
            'twitter'    =>  $this->twitter??null,
            'instagram'  =>  $this->instagram??null,
        ];
    }
}
