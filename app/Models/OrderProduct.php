<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\ReturnReason;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    //
    protected $table = "order_product";
    protected $guarded = [];
    public function order(){
    	return $this->belongsTo(Order::class);
    }
    public function product(){
    	return $this->belongsTo(Product::class);
    }
    public function return_reason(){
    	return $this->belongsTo(ReturnReason::class);
    }

    public function attributeProduct(){
        return $this->belongsTo(AttributeProduct::class, 'attribute_id');
    }
}
