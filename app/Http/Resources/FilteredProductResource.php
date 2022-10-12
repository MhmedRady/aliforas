<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilteredProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $name = (request()->hasHeader('Accept-Language') && request()->header('Accept-Language') == 'ar-EG')? optional($this->translate('ar'))->name : optional($this->translate('en'))->name;
        $salePrice = round(($this->price / 100) * ($this->before_price ?? 1));
        $salePrecentage = ($this->on_sale && $this->price != $this->before_price) ? "$salePrice %" : 0;

        $product = [
            'id' => $this->id,
            'name' => $name,
            'stars'=>$this->reward_points??0,
            'brand'=>$this->brand->name??'',
            'price'=> $this->price,
            'stock'=> $this->stock,
            'on_sale'=> $this->on_sale,
            'is_hot'=> $this->is_hot,
            'show_for'=> $this->show_for,
            'before_price'=> $this->before_price,
            'sale_precentage'=> $salePrecentage,
            'short_description'=> Str::words(preg_replace('/\r|\n/', "", strip_tags($this->description)), 15),
            'manufacturer'=>$this->manufacturer->name??'',
            'url' => route('products.show', $this->slug),
            'percent' => $this->percent,
            'quickView' => route('products.quick-view', $this),
            'inWish' => (bool)$this->userWishlist()->count(),
            'inRecent' => false,
            'inCart' => auth()->guard('web')->check()?(bool) userCart()->has("product_$this->id"):apiUserCart()->has("product_$this->id"),
            'images' => $this->whenLoaded('images', function () {
                return $this->images->map(function ($image) {
                    return $image->image_url(312, 340);
                });
            })
        ];

        if ($this->seller && $this->branch->count()>0){
            $product['branch'] =
                $this->whenLoaded('branch', function (){
                    return new SellerBranchResource($this->branch()->first());
                });
        }else {
            $product['branch'] = null;
        }
        return $product;

    }
}
