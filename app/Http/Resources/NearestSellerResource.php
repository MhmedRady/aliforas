<?php

namespace App\Http\Resources;

use App\Http\Resources\SellerBranchResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NearestSellerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            =>   $this->id,
            'name'          =>   $this->name,
            'email'         =>   $this->email,
            'phone'         =>   $this->phone,
            'gender'        =>   $this->gender,
            'profile_image' =>   $this->profile_image,
            'branches'      =>   SellerBranchResource::collection($this->sellerBranch),
        ];
    }
}
