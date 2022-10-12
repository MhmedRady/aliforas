<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'amount',
        'start',
        'end',
        'usage_times',
        'user_usage_times',
        'min_order',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'coupon_category');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getStartAttribute($value)
    {
        return $this->attributes['start'] = Carbon::parse($value);
    }

    public function getEndAttribute($value)
    {
        return $this->attributes['end'] = Carbon::parse($value);
    }
}
