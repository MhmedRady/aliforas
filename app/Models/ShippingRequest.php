<?php

namespace App\Models;

use App\Models\ShippingCompany;
use Illuminate\Database\Eloquent\Model;

class ShippingRequest extends Model
{
    //
    public function company(){
        return $this->belongsTo(ShippingCompany::class);
    }
}
