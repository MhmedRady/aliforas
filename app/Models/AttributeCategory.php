<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeCategory extends Model
{
    use HasFactory, Translatable;
    public $table='attribute_categories';
    public array $translatedAttributes = ['name'];

    protected $fillable = ['category_id','attribute_id','is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'group_id');
    }

}
