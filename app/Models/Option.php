<?php

namespace App\Models;

use App\Models\OptionValue;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'field_id',
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function values()
    {
        return $this->hasMany(OptionValue::class);
    }
}
