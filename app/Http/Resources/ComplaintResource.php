<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
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
            'from' => $this->from,
            'to' => $this->to,
            'title' => $this->title,
            'body' => $this->body,
            'date_time' => date( 'd M Y, H:i:s',strtotime($this->created_at)),
            'created_at' => $this->date_time,
            'sender' => new SellerResource($this->sender),
            'recipient' => new SellerResource($this->recipient),
        ];
    }
}
