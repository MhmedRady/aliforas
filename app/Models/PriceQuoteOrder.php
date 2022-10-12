<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PriceQuoteOrder extends Model
{

    use HasFactory,Notifiable;

    protected $fillable = [
        'user_id',
        'user_address_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status_id',
        'admin_id',
        'viewed_at',
        'total'
    ];

    protected $appends = ['orderStatus'];
    protected $with = ['user_address','orderProduct'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id')->where('is_admin',1);
    }


    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(PriceQuoteOrderItem::class);
    }

    public function getOrderStatusAttribute()
    {
        return $this->status->name??null;
    }
}
