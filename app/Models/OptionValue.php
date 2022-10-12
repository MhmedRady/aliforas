<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = [
        'option_id',
        'value'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
