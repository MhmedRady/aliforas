<?php

use App\Models\Module;
use App\Cart\DBStorage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Wishlist;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use App\Models\BundleProduct;
use App\Models\CouponProduct;
use App\Models\ProductPromotion;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Darryldecode\Cart\Facades\CartFacade;
use App\Notifications\Phone\PhoneMessageService;

function module($place)
{
    $module = Module::wherePlace($place)->whereIsActive(1)->first();
    if (!$module) {
        return '';
    }
    $content = json_decode($module->content);
    $locale = app()->getLocale();

    $view = view('modules.' . $place, compact('content', 'locale'));
    return $view;
}

function modules()
{
    $modules = Module::whereIsActive(1)->orderBy('order_id', 'ASC')->get();

    $html = '';
    foreach ($modules as $module) {
        $content = json_decode($module->content);
        $locale = app()->getLocale();
        $view = view('modules.' . $module->place, compact('content', 'locale'));
        $html .= $view;
    }

    return $html;
}

function getPageDir()
{
    return \LaravelLocalization::getCurrentLocaleDirection();
}

function categories()
{
    $dbCat = Category::get();

    $categories = [];
    getCategories($dbCat, $categories);

    return $categories;
}

function words_limit($str, $maxlen): string
{
    if (strlen($str) <= $maxlen) {
        return $str;
    }

    $newstr = substr($str, 0, $maxlen);
    if (substr($newstr, -1, 1) != ' ') {
        $newstr = substr($newstr, 0, strrpos($newstr, " ")) . '...';
    }

    return $newstr;
}

function upload_file($file, $folder, $width = 1000, $height = null)
{
    if ($file instanceof UploadedFile && $file->isValid()) {
        $fileName = $file->hashName();
        $publicDisk = Storage::disk('public');
        $pathLocation = $publicDisk->path("uploads/$folder");

        if (!is_dir($pathLocation)) {
            mkdir($pathLocation);
        }
        Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save("$pathLocation/$fileName");
        return $fileName;
    }
    return null;
}

function upload_product_file(UploadedFile $file, $size = 800)
{
    return upload_file($file, 'products', $size);
}

function upload_file_original($file, $folder)
{
    if ($file && $file->isValid()) {
        $image_extension = $file->getClientOriginalExtension();
        $img_new_name = $file->getClientOriginalName();

        $path = strtolower("images/" . $folder . "/" . $img_new_name);
        $image = file_get_contents($file);
        Storage::put($path, $image);

        return strtolower($img_new_name);
    }
    return null;
}

function lang_url($url)
{
    return LaravelLocalization::localizeUrl($url);
}

function url_lang($url, $locale)
{
    return LaravelLocalization::localizeUrl($url, $locale);
}

function route_lang($route, $params = [])
{
    return LaravelLocalization::localizeURL(route($route, $params, false), app()->getLocale());
}

function getCategories($categories = null, &$result = [], $parent_id = 0, $depth = 0)
{
    if (!$categories) {
        $categories = Category::all();
    }

    //filter only categories under current "parent"
    $cats = $categories->filter(function ($item) use ($parent_id) {
        return $item->parent_id == $parent_id;
    });
    //loop through them
    foreach ($cats as $cat) {
        //add category. Don't forget the dashes in front. Use ID as index
        $result[$cat->id] = str_repeat('-', $depth) . ($depth ? ' ' : '') . $cat->name;
        //go deeper - let's look for "children" of current category
        getCategories($categories, $result, $cat->id, $depth + 1);
    }
}

function replaceLang($local)
{
    $segments = request()->segments();
    if (isset($segments[0])) {
        if (strlen($segments[0]) > 2) {
            if ($local == 'en') {
                return url('/en/' . implode('/', $segments));
            } else {
                return url(implode('/', $segments));
            }
        }
    }
    $segments[0] = $local;
    return url(implode('/', $segments));
}

function getWishlistUser()
{
    $uid = auth()->id();
    $wishlistItems = Wishlist::where('user_id', $uid)->pluck('product_id');

    $products = Product::with('translations:id,product_id,name,locale,slug')
        ->whereIn('id', $wishlistItems)
        ->select('id', 'thumbnail', 'price')
        ->get();

    $counter = 0;
    $products = $products->map(function ($item) use (&$counter) {
        $outPut = [];
        $outPut['id'] = $item['id'];
        $outPut['url'] = $item['url'];
        $outPut['name'] = $item['name'];
        $outPut['slug'] = $item['slug'];
        $outPut['price'] = $item['price'];
        $outPut['thumbnail'] = $item['thumbnail'];
        $outPut['description'] = $item['description'];
        $counter += $item['price'];
        return $outPut;
    })->all();
    return $products;
}

function getWishSession()
{
    $wishlist = (session()->has('products.wishlist'))
        ? session()->get('products.wishlist') :
        [];

    $products = Product::with('translations:id,product_id,name,locale,slug')
        ->whereIn('id', array_keys($wishlist))
        ->select('id', 'thumbnail', 'price')
        ->get();

    $counter = 0;
    $products = $products->map(function ($item) use (&$counter) {
        $outPut = [];
        $outPut['id'] = $item['id'];
        $outPut['url'] = $item['url'];
        $outPut['name'] = $item['name'];
        $outPut['slug'] = $item['slug'];
        $outPut['price'] = $item['price'];
        $outPut['thumbnail'] = $item['thumbnail'];
        $outPut['description'] = $item['description'];
        $counter += $item['price'];
        return $outPut;
    })->all();
    return $products;
}

function getWishListsProductsId()
{
    $ids = [];
    $wishlist = (session()->has('products.wishlist'))
        ? session()->get('products.wishlist') :
        [];

    $products = Product::with('translations:id,product_id,name,locale,slug')
        ->whereIn('id', array_keys($wishlist))
        ->select('id', 'thumbnail', 'price')
        ->get();


    $counter = 0;
    $products = $products->map(function ($item) use (&$counter) {
        $outPut = [];
        $outPut['id'] = $item['id'];
        return $outPut;
    })->all();

    foreach ($products as $product) {
        array_push($ids, $product['id']);
    }

    return $ids;
}

function getCompareSession()
{
    $compare = (session()->has('compare'))
        ? session()->get('compare') :
        [];
    return count($compare);
}

function getCompareProductsId()
{
    $ids = [];
    $wishlist = (session()->has('products.wishlist'))
        ? session()->get('products.wishlist') :
        [];

    $products = Product::with('translations:id,product_id,name,locale,slug')
        ->whereIn('id', array_keys($wishlist))
        ->select('id', 'thumbnail', 'price')
        ->get();


    $counter = 0;
    $products = $products->map(function ($item) use (&$counter) {
        $outPut = [];
        $outPut['id'] = $item['id'];
        return $outPut;
    })->all();

    foreach ($products as $product) {
        array_push($ids, $product['id']);
    }

    return $ids;
}

function sendPhoneMessageNotification($text, $receiver)
{
    $phoneMessage = new PhoneMessageService;
    $phoneMessage->messageText = $text;
    $phoneMessage->messageReceiver = ($receiver) ? $receiver : '';
    return $phoneMessage->sendMessage();
}

function logToDatabase($payload)
{
    return Log::channel('db')->info('m', $payload);
}

function priorties()
{
    return Priority::all();
}

function priority($order_id, $id)
{
    $product = Product::find($id);
    $priorties = Priority::all();

    $orders = [];
    if (count($product->get_bundle_products($id)) > 0) {
        array_push($orders, Priority::where('name', 'bundle')->first()->order_id);
    }
    if (count($product->combos) > 0) {
        array_push($orders, Priority::where('name', 'combo')->first()->order_id);
    }
    if ($product->is_hot) {
        array_push($orders, Priority::where('name', 'hot')->first()->order_id);
    }
    if ($product->on_sale) {
        array_push($orders, Priority::where('name', 'on_sale')->first()->order_id);
    }

    foreach ($orders as $key => $order) {
        if ($order < $order_id) {
            return false;
        }
    }
    return true;
}

function get_priority_array()
{
    return [
        'combo_order_id' => Priority::where('name', 'combo')->first()->order_id,
        'on_sale_order_id' => Priority::where('name', 'on_sale')->first()->order_id,
        'hot_order_id' => Priority::where('name', 'hot')->first()->order_id,
        'promotion_order_id' => Priority::where('name', 'promotion')->first()->order_id,
        'bundle_order_id' => Priority::where('name', 'bundle')->first()->order_id,
        'coupon_order_id' => Priority::where('name', 'coupon')->first()->order_id
    ];
}

function get_product_priority_array($id)
{
    $priority = get_priority_array();
    $product = Product::find($id);
    $offer = [];
    if ($product->is_bundle) {
        $offer['bundle_order_id'] = $priority['bundle_order_id'];
    }
    if (count($product->promotions()->get()) > 0) {
        $offer['promotion_order_id'] = $priority['promotion_order_id'];
    }
    if ($product->on_sale) {
        $offer['on_sale_order_id'] = $priority['on_sale_order_id'];
    }
    if ($product->is_hot) {
        $offer['hot_order_id'] = $priority['hot_order_id'];
    }
    if (count($product->coupons()->get()) > 0) {
        $offer['coupon_order_id'] = $priority['coupon_order_id'];
    }
    return $offer;
}

function has_coupon($id)
{
    $product = Product::find($id);
    $offer = get_product_priority_array($id);
    if (count($product->coupons()->get()) == 0) {
        return false;
    } elseif ($offer['coupon_order_id'] == min($offer)) {
        return true;
    } else {
        return false;
    }
}

function has_this_coupon($coupon_id, $product_id)
{
    if ($coupon_product = CouponProduct::where('coupon_id', $coupon_id)->where('product_id', $product_id)->first()) {
        return true;
    }
    return false;
}

function coupon_has_priority($product_id)
{
    $offer = get_product_priority_array($product_id);
    if (isset($offer['coupon_order_id']) && $offer['coupon_order_id'] == min($offer)) {
        return true;
    }
    return false;
}

function has_any_discount($id)
{
    $product = Product::find($id);
    if ($product->on_sale || $product->is_hot || $promotion = ProductPromotion::where('product_id', $id)->first() || $bundle = BundleProduct::where('product_id', $id)->first() || $bundle = BundleProduct::where('product_id', $id)->first()) {
        return true;
    } else {
        return false;
    }
}

function split_array($array, $parts)
{
    $t = 0;
    $array = json_decode($array);
    $result = array_fill(0, $parts - 1, array());
    $max = ceil(count($array) / $parts);
    foreach ($array as $v) {
        count($result[$t]) >= $max and $t++;
        $result[$t][] = $v;
    }
    return $result;
}

function getWishCount(): int
{
    return count((array)session("products.wishlist")) ?? 0;
}


/******* ********/

function main_setting_key_value($setting, $key)
{
    return ($setting->where('key', $key)->first()->value??'');
}

function getCartCount(): int
{
    return count((array)session("products.cartList")) ?? 0;
}

function getCartList()
{
    return session()->has("products.cartList") ? session()->get("products.cartList") : [];
}

function userNameSplit($name, $limit = 2)
{
    $words = explode(" ", $name,$limit);
    $acronym = '';
    foreach ($words as $w) {
        $acronym .= " " . $w[0];
    }
    return $acronym;
}

function rondColor(){
    $colors = ['primary', 'danger', 'success', 'dark', 'light', 'secondary'];

    return $colors[array_rand($colors)];
}

function headerCategories()
{
    return Category::query()->orderBy('products_count', 'DESC')->selector()->take(10)->get();
}

function pageUrl(object $products): string
{
    return substr_replace($products->nextPageUrl() ?? $products->previousPageUrl(), "", -1);
}

function genRandomCode($type = 'int', $n = 7)
{
    $characters = $type == 'int' ? implode(range('0', '9')) : implode(array_merge(range('A', 'Z'), range('0', '9'), range('a', 'z')));

    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function htmlFilter($html)
{
    $regex = '/<([^>\s]+)[^>]*>(?:\s*(?:<br \/>|<br>|<br\/>|&nbsp;|&thinsp;|&ensp;|&emsp;|&#8201;|&#8194;|&#8195;)\s*)*<\/\1>/m';
    return preg_replace($regex, '', strip_tags($html, ['br', 'a']));
}

/**
 * @return Cart
 */
function userCart()
{
    $cartId = Auth::guard('web')->check() ? 'user_' . Auth::guard('web')->id() : Session::getId();

    return CartFacade::session($cartId);
}

/**
 * @return Cart
 */
function apiUserCart()
{
    $cartId =  Auth::check() ? 'user_' .  Auth::user()->id : Session::getId();
    return CartFacade::session($cartId);
}

/**
 * @return string
 */
function json($data)
{
    return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
}


if (!function_exists('signedRoute')) {
    /**
     * get auth user.
     *
     * @param string $name
     * @param array $parameters
     * @param DateTimeInterface|DateInterval|int|null $expiration
     * @param bool $absolute
     * @return string
     */
    function signedRoute(string $name, array $parameters = [], $expiration = null, bool $absolute = true): string
    {
        return URL::signedRoute($name, $parameters, $expiration, $absolute);
    }
}

if (!function_exists('created_at_filter')) {
    /**
     * @param EloquentDataTable $DataTables
     * @return EloquentDataTable
     */
    function created_at_filter(EloquentDataTable $DataTables)
    {
        return $DataTables->filterColumn('created_at', function ($query, $keyword) {
            $connection = config('database.default');
            $driver = config("database.connections.{$connection}.driver");
            if ($driver === 'mysql') {
                $sql = "DATE_FORMAT(created_at,'%Y/%m/%d') like ?";
            } elseif ($driver === 'pgsql') {
                $sql = "to_char(created_at,'YYYY/MM/DD') like ?";
            } else {
                return;
            }
            $query->whereRaw($sql, [(config('datatables.search.smart') === true ? '%' : '') . "$keyword%"]);
        });
    }

    function currentRoute()
    {
        return \Request::route()->getName();
    }

    function checkCurrentRoute($name):bool
    {
        return currentRoute() === $name;
    }

    function diffToDateTimes($date1, $date2 = null)
    {
        $datetime1 = Carbon::parse(is_null($date2)? date('Y-m-d H:i:s'): date('Y-m-d H:i:s' ,strtotime($date2)));//start time
        $datetime2 = Carbon::parse(date('Y-m-d H:i:s' ,strtotime($date1)));//end time
        return $datetime1->diffInDays($datetime2);
    }
}
