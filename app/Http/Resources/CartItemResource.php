<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $cart_item = [
            'id' => $this->get('id'),
            'name' => $this->get('associatedModel')->name,
            'quantity' => $this->get('quantity'),
            'price' => $this->get('price'),
            'attributes' => $this->get('attributes')->count(),
            'product' => new FilteredProductResource(
                $this->get('associatedModel')->refresh()->load('images')
            ),
        ];
        return $cart_item;
    }
}
