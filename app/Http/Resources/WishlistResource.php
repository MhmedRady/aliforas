<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        =>  $this->id,
            'type'      =>  'wishlist',
            'product'   =>  new ProductResource($this->product),
        ];
    }
}
