<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id"            =>  $this->id,
            "first_name"    =>  $this->first_name,
            "last_name"     =>  $this->last_name,
            "phone"         =>  $this->phone,
            "address"       =>  $this->address,
            "postal_code"   =>  $this->postal_code,
            "state"         =>  new StateResource($this->state),
            "city"          =>  new CityResource($this->city),
        ];
    }
}
