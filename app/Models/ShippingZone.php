<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShippingCompany;
use Illuminate\Database\Eloquent\Casts\Attribute;
class ShippingZone extends Model
{
    //
    public function getAreasAttribute($val)
    {
        return json_decode($val);
    }

    public function company(){
    	return $this->belongsTo(ShippingCompany::class);
    }

}
