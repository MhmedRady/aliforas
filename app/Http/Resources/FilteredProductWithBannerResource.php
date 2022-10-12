<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class FilteredProductWithBannerResource extends JsonResource
{
    public function toArray($request): array
    {
        $name = (request()->hasHeader('accept-language') && request()->header('accept-language') == 'ar-EG')? optional($this->translate('ar'))->name : optional($this->translate('en'))->name;
        $sliderurl = URL::to('/storage/uploads/slider') . '/';
        $sliders = $this->sliders->map(fn ($q) =>  $sliderurl . $q->image);

        return [
            'id' => $this->id,
            'name' => $name,
            'stars'=>$this->reward_points??0,
            'brand'=>$this->brand->name??'',
            'price'=> $this->price,
            'stock'=> $this->stock,
            'show_for'=> $this->show_for,
            'before_price'=> $this->before_price,
            'short_description'=> Str::words(preg_replace('/\r|\n/', "", strip_tags($this->description)), 15),

            'manufacturer'=>$this->manufacturer->name??'',

            'url' => route('products.show', $this->slug),
            'percent' => $this->percent,
            'quickView' => $sliders,
            'inWish' => (bool)$this->userWishlist()->count(),
            'inRecent' => false,
            'inCart' => auth()->guard('web')->check()?(bool) userCart()->has("product_$this->id"):apiUserCart()->has("product_$this->id"),
            'images' => $this->whenLoaded('images', function () {
                return $this->images->map(function ($image) {
                    return $image->image_url(312, 340);
                });
            })
        ];
    }
}
