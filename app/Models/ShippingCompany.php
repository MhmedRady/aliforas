<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    public function zones (){
        return $this->hasMany(ShippingZone::class,'company_id');
    }
}
