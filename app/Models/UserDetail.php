<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'country_id',
        'address',
        'city_id',
        'state_id',
        'postal_code',
        'user_id',
        'email',

        'national_id',
        'age',
        'employer',
    ];
}
