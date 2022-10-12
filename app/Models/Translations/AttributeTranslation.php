<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\AttributeTranslationFatcoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['locale', 'attribute_id', 'name'];

    protected static function newFactory()
    {
        return AttributeTranslationFatcoryFactory::new();
    }
}
