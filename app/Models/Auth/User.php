<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends \App\Models\User
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
//        if (auth()->guard('web')->check() || auth()->guard('sanctum')->check()) {
            static::addGlobalScope('is_user', function (Builder $builder) {
                $builder->where('is_admin', false)->where('is_seller', false);
            });
//        }
    }

}
