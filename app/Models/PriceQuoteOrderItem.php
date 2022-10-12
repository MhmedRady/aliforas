<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\PriceQuoteOrder;

class PriceQuoteOrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];

//    protected $appends = ['product_name'];

    public function product()
    {
        return$this->belongsTo(Product::class,'product_id');
    }

    public function orderPrice()
    {
        return$this->belongsTo(PriceQuoteOrder::class,'price_quote_order_id');
    }
}
