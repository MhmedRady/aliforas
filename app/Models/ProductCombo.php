<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCombo extends Model
{
    public $table='combo_product';
    protected $fillable=['product_id','combo_id'];
}
