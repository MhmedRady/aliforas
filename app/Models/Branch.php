<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Localization;

class Branch extends Model
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['name'];

    protected $table = 'branches';

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'branch_product');
    }

    public function webProducts()
    {
        return $this->hasManyThrough(Product::class, ProductBranch::class, "branch_id", "id", "id", "product_id", "product_id");
    }

    public function seller()
    {
        return $this->belongsTo('App\Models\Auth\Seller');
    }

    public function branchWithProduct(){
        return $this->hasMany(BranchProduct::class);
    }
}
