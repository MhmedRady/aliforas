<?php

namespace App\Models\Translations;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CategoryTranslationsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTranslation extends Model
{
    use HasFactory;
    protected $table = "category_translations";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function newFactory()
    {
        return CategoryTranslationsFactory::new();
    }
}
