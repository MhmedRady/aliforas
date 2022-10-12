<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use Translatable;

    public array $translatedAttributes = ['name', 'description'];
    protected $fillable = ['price', 'duration', 'is_active'];
}
