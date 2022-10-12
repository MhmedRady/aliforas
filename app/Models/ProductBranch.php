<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Product;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductBranch extends Model
{

    protected $table = "branch_product";

    public $timestamps = false;

    public function Branch() {
        return $this->belongsTo(Branch::class);
    }

    public function product (){
        return $this->belongsTo(Product::class);
    }

}
