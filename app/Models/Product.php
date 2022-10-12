<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use App\Scopes\AvailableScope;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Translations\ProductTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        Product::creating(function ($model) {
            if (optional(auth()->user())->is_seller) {
                $model->seller_id = auth()->id();
            }
        });
    }

    public array $translatedAttributes = ['name', 'description', 'slug'];

    protected $fillable = ['is_active', 'return_allowed', 'return_duration', 'show_for', 'price', 'stock', 'minimum_stock', 'on_sale', 'is_bundle', 'before_price', 'bundle_start', 'bundle_end', 'bundle_image', 'sold', 'is_hot', 'hot_price', 'seller_id', 'manufacturer_id', 'brand_id'];

    //protected $appends = ['added_to_wishlist', 'added_to_cart', 'name', 'slug'];
    protected $appends = ['percent'];

    protected $with = ['images'];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product');
    }

    public function attributesProduct()
    {
        return $this->hasMany(AttributeProduct::class);
    }

    public function productAttributesHasQuantity()
    {
        return $this->attributesProduct()->where('quantity', '>', 0)->whereHas(
            'attribute',
            fn ($q) =>$q->where('is_active', true)->whereNotNull('group_id')
                ->whereHas('parentAttr', fn ($q) =>$q->where('is_active', true))
        )->orderByDesc('id');
    }

    public function branch()
    {
        return $this->belongsToMany(Branch::class, 'branch_product');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class, 'product_id');
    }

    public function image()
    {
        return $this->hasOne(ProductImage::class, "product_id");
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function userWishlist()
    {
        return $this->wishlist()->where('user_id', auth()->id());
    }

    /*========================================================================================================================*/

    ##### ATTRIBUTE FUNCTIONS
    /*========================================================================================================================*/

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return $this->image->image_url;
        }
        return '';
    }
    public function getPercentAttribute()
    {
        if ($this->on_sale || $this->is_hot) {
            $percent = ($this->price/($this->before_price != 0 ?$this->before_price: 1))*100;
            return number_format($percent).'%';
        }
        return 0;
    }

    public function getInWishAttribute()
    {
        return false;
    }

    public function price_quote_order_items()
    {
        return $this->hasMany(PriceQuoteOrderItem::class);
    }

    public function price_quote_orders()
    {
        return $this->hasManyThrough(
            PriceQuoteOrder::class,
            PriceQuoteOrderItem::class,
            'product_id',
            'id',
            'id',
            'price_quote_order_id'
        );
    }

    public function viewers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'recent_viewed')->withTimestamps();
    }
}
