<?php

namespace App\Models;

use App\Models\Translations\CityTranslation;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class City extends Model
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['name'];
    protected $fillable = ['code'];
    protected $hidden = [ 'updated_at'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->hasOneThrough(Country::class, State::class);
    }
}
