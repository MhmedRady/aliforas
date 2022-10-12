<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $hidden = ['product_id', 'created_at', 'updated_at'];

    public function getImageUrlAttribute()
    {
        if (filter_var($this->image, FILTER_VALIDATE_URL) !== false)
            return $this->image;
        $path = urlencode($this->image) ?: 'default.png';
        return asset("storage/uploads/products/{$path}");
    }

    public function image_url($w, $h)
    {
        if (filter_var($this->image, FILTER_VALIDATE_URL) !== false)
            return $this->image;
        $path = urlencode($this->image) ?: 'default.png';
        return asset("storage/uploads/{$w}x{$h}/products/{$path}");
    }
}
