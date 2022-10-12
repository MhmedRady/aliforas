<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemApiResource extends JsonResource
{
    public function toArray($request): array
    {
        $cart_item = [
            'id' => $this->get('id'),
            'name' => $this->get('associatedModel')->name,
            'stock' => $this->getProductStock($this->get('id')),
            'quantity' => $this->get('quantity'),
            'price' => $this->get('associatedModel')->refresh()->price,
            'attributes' => $this->get('attributes')->count(),
            'product_id' => $this->get('associatedModel')->refresh()->id,
            'image' => $this->get('associatedModel')->refresh()->images->first()->image,
        ];

        if (!config("setting.pricing")) {
            unset($cart_item['price'], $cart_item['attributes']);
        }
        return $cart_item;
    }

    public function getProductStock($product_id){
        $ex = explode('_',$product_id);
        $id = array_pop($ex);
        $product = Product::query()->find($id);
        if ($product){
            return (int) $product->stock;
        }else{
            return 0;
        }
    }
}
