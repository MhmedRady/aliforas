<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['name'];
    protected $fillable = ['country_code'];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
