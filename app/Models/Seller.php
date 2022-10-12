<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'document_id', 'legal_type', 'store', 'user_id'
    ];

//    protected $fillable = [
//        'document_id', 'document_first_name', 'document_last_name', 'document_expiry_date',
//        'pickup_city', 'account_legal_type', 'pickup_street', 'pickup_contact_number',
//        'pickup_building_number', 'store_name',"address", "lat", "lng", 'user_id'
//    ];

}
