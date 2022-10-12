<?php

namespace App\Models;

use App\Models\Category;
use App\Helpers\Localization;
use App\Models\AttributeProduct;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\AttributeFatcory;
use App\Observers\Admin\AttributeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use Translatable, HasFactory;

    protected static function boot()
    {
        parent::boot();
        Attribute::observe(AttributeObserver::class);
    }

    public array $translatedAttributes = ['name'];
//    protected $with = ['AttributeTranslations'];

    protected $fillable = [
        'group_id',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

//    public function AttributeTranslations()
//    {
//        $locale = Localization::getLocale();
//        return $this->hasMany('App\Models\Translations\AttributeTranslation', 'attribute_id')->where('locale', $locale);
//    }

    public function parentAttr()
    {
        return $this->belongsTo(Attribute::class, 'group_id', 'id');
    }

    public function childes()
    {
        return $this->hasMAny(Attribute::class, 'group_id', 'id');
    }

    public function scopeParents($query)
    {
        return $query->where('group_id', null);
    }

    public function scopeChildes($query)
    {
        return $query->whereNoNull('group_id');
    }

    public function attr($group, $attr)
    {
        $attribute = Attribute::find($attr);
        if ($attribute) {
            if (isset($attribute) && $attribute->group_id == $group) {
                return $attribute;
            }
        }
    }

    public function product($product, $attr)
    {
        return AttributeProduct::where('product_id', $product)->where('attribute_id', $attr)->first();
    }

//    function categoryAttrFromParent($parent)
//    {
//        return $this->hasOneThrough(Category::class, AttributeCategory::class, 'attribute_id', 'id_', 'category_id', 'group_id');
//        return $this->hasOneThrough(Category::class,AttributeCategory::class, 'category_id', 'group_id');
//    }

//    function category()
//    {
//        return $this->hasOneThrough(Category::class, AttributeCategory::class, 'attribute_id', 'id_', 'category_id', 'group_id');
//        return $this->belongsToMany(Category::class,AttributeCategory::class)
//            ->get()->filter(function ($q){
//            return $q->;
//        });
//    }

    public function categories()
    {
        return $this->hasMany(AttributeCategory::class);
    }

    public function products()
    {
        return $this->hasMany(AttributeProduct::class, 'attribute_id');
    }

    public function attrWithProducts()
    {
        return $this->belongsToMany(Product::class, 'attribute_product');
    }

    public function group_categories()
    {
        return $this->belongsToMany(Category::class, 'attribute_categories');
    }
//
    public function getCategoriesId()
    {
        return $this->categories->pluck('category_id')->toArray();
    }

    protected static function newFactory()
    {
        return AttributeFatcory::new();
    }
}
