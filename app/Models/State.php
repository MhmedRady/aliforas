<?php

namespace App\Models;

use App\Models\Translations\StateTranslation;
use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class State extends Model
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['name'];
//    protected $appends = ['zone_list'];
    protected $hidden = ['created_at', 'updated_at'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        $local = App::getLocale();
        return $this->hasMany(City::class);
    }


    public function getZoneListAttribute()
    {
        return ShippingZone::query()
            ->orderByDesc('first_kg')
            ->get()->filter(function ($zone){
            return in_array($this->id, $zone->areas);
        });
    }
}
