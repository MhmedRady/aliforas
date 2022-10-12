<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\BrandTranslationsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandTranslation extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected static function newFactory()
    {
        return BrandTranslationsFactory::new();
    }
}
