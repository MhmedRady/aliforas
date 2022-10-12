<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\True_;

class SellerBranchResource extends JsonResource
{
    public function toArray($request): array
    {
        $branch = [
            'id'        =>   $this->id,
            'name'      =>   $this->name,
            'lng'       =>   $this->lng,
            'lat'       =>   $this->lat,
            'address'   =>   $this->address,
            'distance'  =>   $this->distance,
            'views'  =>   $this->views,
            'seller'    =>   $this->seller->name??null,
//            'translations'      =>  [
//                'en'    =>  optional($this->translate('en'))->name,
//                'ar'    =>  optional($this->translate('ar'))->name,
//            ],
        ];

        if ($request->has('products') && $request->get('products')){
            $branch['products'] =  ProductResource::collection($this->products->where('is_active', true)) ;
        }

        return $branch;
    }
}
