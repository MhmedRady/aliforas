<?php

namespace App\Models;

use Database\Factories\BrandFactory;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\BrandTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use Translatable, HasFactory;

    public array $translatedAttributes = ['name'];

    protected $appends = ['logo_thumb'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function get_seo($lang, $column, $id)
    {
        $product = BrandTranslation::where('locale', $lang)->where('brand_id', $id)->first();
        if (!$product) {
            return '';
        } else {
            return $product->$column;
        }
    }

    public function getLogoUrlAttribute()
    {
        if (filter_var($this->logo, FILTER_VALIDATE_URL) !== false) {
            return $this->logo;
        }
        $path = urlencode($this->logo) ?: 'default.png';
        return asset("storage/uploads/brands/{$path}");
    }

    public function logo_url($w, $h)
    {
        if (filter_var($this->logo, FILTER_VALIDATE_URL) !== false) {
            return $this->logo;
        }
        $path = urlencode($this->logo) ?: 'default.png';
        return asset("storage/uploads/{$w}x{$h}/brands/{$path}");
    }

    public function getLogoThumbAttribute()
    {
        return $this->logo_url(64, 64);
    }

    protected static function newFactory()
    {
        return BrandFactory::new();
    }
}
