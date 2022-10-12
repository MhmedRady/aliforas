<?php

namespace App\Models;

use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use App\Models\PriceQuoteOrder;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
//    protected static function booted()
//    {
//        if (auth()->guard('web')->check() || auth()->guard('sanctum')->check()) {
//            static::addGlobalScope('is_user', function (Builder $builder) {
//                $builder->where('is_admin', false)->where('is_seller', false);
//            });
//        }
//    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'verification_code',
        'email_verified_at',
        'password',
        'profile_image',
        'is_admin',
        'is_seller',
        'is_active',
        'gender',
        'dob',
        'order_status_permissions',
        'api_token',

        'age',
        'national_id',
        'employer',
//        'role_id',
    ];

    protected $appends = ['first_name','last_name'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'order_status_permissions' => 'array',
        'email_verified_at' => 'datetime',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'seller_id');
    }

    public function loginUserOrders()
    {
        return $this->hasMany(Order::class);
    }

    public function branch()
    {
        if ($this->is_seller === 1) {
            return $this->hasMany('App\Models\Branch');
        }
    }

    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function scopeCustomers($query)
    {
        return $query->where([['is_admin', false],['is_seller',false]]);
    }

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }

    public function setPasswordAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['password'] = $value;
        }
    }

    public function wallet($user)
    {
        return Wallet::where('user_id', $user)->get();
    }

    public function points($user)
    {
        return Point::where('user_id', $user)->get();
    }

    public function orders($user)
    {
        return Order::where('user_id', $user)->get();
    }

    public function order_total($id)
    {
        $order = Order::find($id);
        $total_price = 0;

        $order->products->map(function (Product $product) use (&$total_price) {
            if ($product->pivot->total != $product->pivot->price_after) {
                $total_price += $product->pivot->price_after;
            } else {
                $total_price += $product->pivot->total;
            }

            return $product;
        });
        return $total_price;
    }

    public function get_state($id)
    {
        return State::find($id);
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id')->withDefault(function () {
            return new UserDetail();
        });
    }

    public function userAddress()
    {
        return $this->hasOne(UserAddress::class, 'user_id')->withDefault(function () {
            return new UserAddress();
        });
    }

    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    public function userOrders()
    {
        if (config('setting.pricing')){
            return $this->hasMany(Order::class, 'user_id');
        }else {
            return $this->hasMany(PriceQuoteOrder::class, 'user_id');
        }
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id');
    }

    public function sellerFile()
    {
        return $this->hasOne(SellerFile::class, 'user_id');
    }

    public function city()
    {
        $local = App::getLocale();
        return $this->hasOneThrough(City::class, UserDetail::class, 'user_id', 'id', 'id', 'user_id');
        //->select('cities.id',"cities.city_name_{$local} AS City");
    }

    public function country()
    {
        $local = App::getLocale();
        return $this->hasOneThrough(Country::class, UserDetail::class, 'user_id', 'id', 'id', 'country_id');
        //->select('countries.id',"countries.country_name_{$local} As Country");
    }

    public function getGenderAttribute($val)
    {
        if (!is_null($val)) {
            return $val == "male" ? __("auth.male") : __("auth.female");
        }
        return "n/a";
    }

    public function getProfileImageUrlAttribute()
    {
        $profile_image = $this->getAttribute('profile_image');
        if (!empty($profile_image)) {
            if (filter_var($profile_image, FILTER_VALIDATE_URL) !== false) {
                return $profile_image;
            }
            return asset("storage/uploads/250x250/users/{$profile_image}");
        } else {
            return asset('assets/images/avatar.png');
        }
    }

    public function getFirstNameAttribute()
    {
        return $this->attributes['name']?explode(' ', $this->attributes['name'])[0]:'';
    }

    public function getLastNameAttribute()
    {
        if ($this->attributes['name']) {
            $name = explode(' ', $this->attributes['name']);
            array_shift($name);
            return implode(' ', $name);
        }
    }

    public function viewedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'recent_viewed')
        ->withTimestamps()
        ->where('is_active', true)
        ->latest();
    }

    public function wishlists(): BelongsToMany
    {
        return $this->hasMany(Wishlist::class)
        ->latest();
    }
}
