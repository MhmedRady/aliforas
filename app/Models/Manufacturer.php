<?php

namespace App\Models;

use App\Models\Translations\ManufacturerTranslation;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['name', 'slug'];

    protected $appends = ['logo_thumb'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function get_seo($lang, $column, $id)
    {
        $translation = ManufacturerTranslation::query()->where('locale', $lang)->where('manufacturer_id', $id)->first();
        return optional($translation)->$column;
    }

    public function getLogoUrlAttribute()
    {
        if (filter_var($this->logo, FILTER_VALIDATE_URL) !== false)
            return $this->logo;
        $path = urlencode($this->logo) ?: 'default.png';
        return asset("storage/uploads/manufacturers/{$path}");
    }

    public function logo_url($w, $h)
    {
        if (filter_var($this->logo, FILTER_VALIDATE_URL) !== false)
            return $this->logo;
        $path = urlencode($this->logo) ?: 'default.png';
        return asset("storage/uploads/{$w}x{$h}/manufacturers/{$path}");
    }

    public function getLogoThumbAttribute()
    {
        return $this->logo_url(64, 64);
    }

}
