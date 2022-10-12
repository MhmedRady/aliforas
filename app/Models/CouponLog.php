<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponLog extends Model
{
    protected $table = 'coupons_logs';
    protected $fillable = [
        'coupon_id',
        'user_id',
        'order_id',
        'amount_before',
        'amount_after',
        'coupon'
    ];
}
