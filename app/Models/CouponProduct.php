<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    public $table='coupon_product';

    protected $fillable = ['product_id','coupon_id'];
}
