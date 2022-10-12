<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    public $table='promotion_product';
    protected $fillable=['product_id','promotion_id'];
}
