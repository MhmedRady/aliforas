<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image_url' => $this->image_url($request->get('width', 460),$request->get('height', 200)),
            'image_thumb' => $this->image_thumb,
            'is_banner' => (bool)$this->is_banner,
            'title'=> $this->title,
            'sub_title'=> $this->sub_title,
            'description'=> $this->description,
            'product_id' => $this->product_id,
            'product' => $this->product_id ? new ProductResource($this->product) : null,
        ];
    }
}
