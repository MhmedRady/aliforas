<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Etchfoda\Translatable\Translatable;

class Location extends Model
{
    use Translatable;

    public array $translatedAttributes = ['location'];

    // protected $fillable = ['code'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
