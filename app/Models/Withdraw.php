<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduct;

class Withdraw extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_product($id)
    {
        return OrderProduct::find($id);
    }
}
