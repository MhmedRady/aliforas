<?php

namespace App\Models\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class Admin extends User
{
    protected $table = 'users';
//    protected $guard_name = 'admin';
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('is_admin', function (Builder $builder) {
            $builder->where('is_admin', true);
        });
    }

//    public function role()
//    {
//       return \auth()->guard('admin')->user()->getRoleNames()->first();
//    }

}
