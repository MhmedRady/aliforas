<?php

namespace App\Models;

use App\Models\Product;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{

    protected static function boot()
    {
        parent::boot();

        Product::creating(function($model) {
            if(auth()->user()->is_seller){
                $model->seller_id = auth()->id();
            }
        });
    }

    protected $table = "products";
    /* public array $translatedAttributes = ['name', 'description','slug']; */
    protected $fillable = ['is_active','return_allowed','return_duration','price','stock','minimum_stock','on_sale','is_bundle','before_price','bundle_start','bundle_end','bundle_image'];
    protected $hidden = ['created_at', 'updated_at'];
    /* protected $appends = ['added_to_wishlist', 'added_to_cart']; */

/*========================================================================================================================*/
}
