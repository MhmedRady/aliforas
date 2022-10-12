<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PriceQuoteOrder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'phone', 'country_id', 'state_id', 'street',
        'city_id', 'address', 'lat', 'lng', 'ship_to', 'location', 'postal_code', 'build_number'
    ];

    public function getFullNameAttribute()
    {
        $first_name = explode(' ', $this->getAttribute('first_name'))[0];
        $last_name = $this->getAttribute('last_name');
        if (is_null($last_name) && count(explode(' ', $this->getAttribute('first_name'))) > 1)
            $last_name = collect(explode(' ', $this->getAttribute('first_name')))->last();
        return implode(' ', array_filter([
            $first_name,
            $last_name,
        ]));
    }

    public function addressOrders(){
        return $this->hasMany(PriceQuoteOrder::class,'user_address_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
