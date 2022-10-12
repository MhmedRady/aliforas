<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Product Resource
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $name = (request()->hasHeader('accept-language') && request()->header('accept-language') == 'ar-EG')? optional($this->translate('ar'))->name : optional($this->translate('en'))->name;
        $product = [
            'id'    =>  $this->id,
            'type'  =>  'product',
            'name'  =>  $name,
            'description'  =>  $this->description,
            'stock'  =>  $this->stock,
            'image_url'  =>  $this->image_url,
            'minimum_stock'  =>  $this->minimum_stock,
            'on_sale'  =>  $this->on_sale,
            'before_price'  =>  $this->before_price,
            'sold'  =>  $this->sold,
            'percent' => $this->percent,
            'inWish' => (bool)$this->wishlist()->count(),
            'inRecent' => false,
            'inCart' => auth()->guard('web')->check()?(bool) userCart()->has("product_$this->id"):apiUserCart()->has("product_$this->id"),
            'inStock' => (bool)$this->stock,
            'images'  =>  $this->images->pluck('image'),
        ];

        if (config('setting.pricing')){
            $product['price'] = $this->price;
            if (auth()->user()){
                if ($this->seller && $this->branch->count()>0){
                    $product['branch'] =
                        $this->whenLoaded('branch', function (){
                            return new SellerBranchResource($this->branch()->first());
                        });
                }else {
                    $product['branch'] = null;
                }
            }
        }
        return $product;
    }
}
