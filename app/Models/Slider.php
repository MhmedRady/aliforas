<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Etchfoda\Translatable\Translatable;
use App\Models\Translations\SliderTranslation;

class Slider extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['product_id' ,'is_active', 'image', 'is_banner', 'code'];

    public array $translatedAttributes = ['title','sub_title','description'];

    protected $appends = ['image_thumb'];

    public function image_url($w = null, $h = null)
    {
        if (filter_var($this->image, FILTER_VALIDATE_URL) !== false)
            return $this->image;
        $path = urlencode($this->image) ?: 'default.png';
            return asset("storage/uploads/{$w}x{$h}/slider/{$path}");
    }

    public function getImageThumbAttribute()
    {
        return $this->image_url(64, 64);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

//    public function setCodeAttribute()
//    {
//        $this->attributes['code'] = 'banner';
//    }

}
