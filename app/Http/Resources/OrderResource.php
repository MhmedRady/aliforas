<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        $order = [
            'id'    =>  $this->id,
            'orderStatus'  =>  $this->orderStatus,
            'user_address'  =>  null,
            'created_at'  =>  $this->created_at->format('Y-m-d H:m'),
        ];

        if (config('setting.pricing')){
            $order['branch'] = null;
            $order['order-products'] = $this->orderProduct->map(
                fn ($item) =>
                [
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                    'product' => new ProductResource($item->product),
                ]
            );
            if (!is_null($this->branch_id)){
                $order['branch']  =  new SellerBranchResource($this->branch);
            }else {
                $order['user_address']  =  $this->user_address->only(['id', 'first_name', 'last_name', 'phone', 'address', 'postal_code']);
            }
        }else{
            $order['user_address']  =  $this->user_address->only(['id', 'first_name', 'last_name', 'phone', 'address', 'postal_code']);
        }

        return $order;
    }
}
