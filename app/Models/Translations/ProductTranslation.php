<?php

namespace App\Models\Translations;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $table = 'product_translations';
    protected $fillable = ['name', 'description', 'slug', 'locale', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
