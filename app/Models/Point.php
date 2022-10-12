<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

use App\Models\MainSetting;

class Point extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function convert_money($points)
    {
        $points_value = MainSetting::where('key', 'point_value')->first();
        $money = $points * $points_value->value;
        return $money;
    }
}
