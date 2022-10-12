<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use App\Models\ShippingZone;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\ShippingCompany;
use App\Models\ShippingRequest;
use Illuminate\Database\Eloquent\Model;
use Etchfoda\Translatable\Translatable;
use App\Models\Product;
use App\Models\State;
use App\Models\Transaction;

class Order extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('id', 'quantity', 'price', 'price_after', 'total', 'attribute_id', 'reward_points', 'discount_type');
    }

    public function products_weight()
    {
        $order = OrderProduct::where('order_id', $this->id)->get();
        $weight = 0;
        foreach ($order as $order_line) {
            $product = Product::find($order_line->product_id);
            $weight += ($product->length * $product->width * $product->height) / 3000;
        }
        return $weight;
    }

    public function payment_method()
    {
        $transaction = Transaction::where('order_id', $this->id)->first();
        return $transaction->payment_type;
    }

    public function get_shipping_request($orderline)
    {
        $request_shipping = ShippingRequest::where('order_id', $this->id)->get();
        if ($request_shipping->count() > 0) {
            foreach ($request_shipping as $rs) {
                if (in_array($orderline, explode(',', $rs->order_lines_ids))) {
                    return [$rs->company->name, $rs->status];
                } else {
                    return "-";
                }
            }
        } else {
            return "-";
        }
    }

    public function get_total_price()
    {
        return OrderProduct::where('order_id', $this->id)->get()->sum('price_after');
    }

    public function get_total()
    {
        return $this->shipping_amount + $this->total;
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function zone()
    {
        return $this->belongsTo(ShippingZone::class);
    }

    public function company()
    {
        return $this->belongsTo(ShippingCompany::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function get_state($id)
    {
        return State::find($id);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function get_product_return_policy($id, $created_at)
    {
        $date1 = strtotime($created_at);
        $date2 = strtotime(now());
        $diff = abs($date2 - $date1);
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $check_return = Category::find($id);
        if ($check_return->return_policy > $days) {
            return "true";
        } else {
            return "false";
        }
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

//    public function userOrders ()
//    {
//        return $this->belongsToMany(User::class,Order::class, 'id','user_id');
//    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }
}
