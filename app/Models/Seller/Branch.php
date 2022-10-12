<?php

namespace App\Models\Seller;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Helpers\Localization;

use App\Models\Branch as BranchModel;

class Branch extends BranchModel
{
    protected static function booted()
    {
        if (auth()->guard('seller')->check()){
            static::addGlobalScope('seller_id', function (Builder $builder){
                $builder->where('seller_id',auth()->guard('seller')->user()->id);
            });
        }
    }
}
