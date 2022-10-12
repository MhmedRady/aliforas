<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Product;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "product_categories";
    protected $fillable = ['id', 'product_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
