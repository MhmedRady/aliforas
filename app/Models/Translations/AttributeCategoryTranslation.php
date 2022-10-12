<?php

namespace App\Models\Translations;

use App\Models\AttributeCategory;
use Illuminate\Database\Eloquent\Model;

class AttributeCategoryTranslation extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
     public function attributes_category()
     {
         return $this->belongsTo(AttributeCategory::class);
     }
}
