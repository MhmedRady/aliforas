<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class LocationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
