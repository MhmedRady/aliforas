<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\State;
use App\Models\Slider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $locale = App::getLocale();
        View::share('locale', $locale);
    }

    public function index(Request $request)
    {

//        return Attribute::query()->whereNull('group_id')->whereHas('categories',function ($q){
//            return $q->whereIn('attribute_categories.category_id',[4,5]);
//        })->with('childes',function ($q){
//            return $q->where('is_active', true)->whereHas('products')->with('attrWithProducts')->withCount('products')->orderByDesc('products_count')->take(5);
//        })->whereHas('attrWithProducts')->whereHas('childes')->withCount('attrWithProducts as products_count')->orderBy('products_count', 'desc')->get();

        if (config('setting.pricing') === true) {
            $specialProducts =
                Product::query()->where('before_price', '>', 0)
                ->whereHas('translations')->whereHas('images')->latest()->limit(10)->get();
        } else {
            $specialProducts =
                Product::query()->withCount('price_quote_orders')
                ->whereHas('translations')->whereHas('images')
                ->orderByDesc('price_quote_orders_count')->limit(20)->get();
        }

        $hotCategories =
                Category::query()->where('is_active', true)
                ->whereHas('products', fn ($q) => $q->whereHas('images'))
                ->withCount('products')->orderByDesc('products_count')
                ->limit(5)->get();

        $slider  = Slider::query()->where('is_active', 1)->get();
        $banners = $slider->where('is_banner', '1');

        $topBrands = Brand::query()->withCount('products')->orderByDesc('products_count')->limit(10)->get();

//        return !is_null($slider->where('is_banner','1')) && $slider->where('is_banner','1')->count()>0? 'is banner' : '';
//        return $slider->where('is_banner','1')->count();
//        return $slider->where('is_banner','0')->count();
        /*$latest = Product::where("is_active", 1)->with(["getImg"])->whereHas("getImg")->withCount('getImg')
            ->select(["id", "seller_id", "stock", "reward_points", "before_price", "price"])->take(3)->get();

        $new = Product::selector()->latest()->take(24)->get();

        $bestSeller = Product::selector()->latest()->take(24)->get();

        $onSale = Product::where("on_sale", "!=", 0)
            ->select("id", "seller_id", "is_active", "stock", "sold", "reward_points", "before_price", "price", "on_sale", "is_hot")
            ->latest()->take(24)->get();

        $isHot = Product::where([["is_active", 1], ["stock", ">", 0], ["is_hot", 1]])->whereHas('image')->whereHas("Translate")
            ->select("id", "seller_id", "stock", "sold", "reward_points", "before_price", "price", "is_hot", "hot_price", "hot_starts_at", "hot_ends_at")
            ->latest()->take(4)->get();
        $new = $new->split(6);
        $bestSeller = $bestSeller->split(6);
        $onSale = $onSale->split(6);
        $onSale = split_array($onSale, 6);*/

        return view('root.index', compact('specialProducts', 'hotCategories', 'slider', 'banners', 'topBrands'));
    }

    public function categoryTab(Request $request, Category $category)
    {
        $category->load('products');
        return view('root.components.category-tab', compact('category'));
    }

    public function quickView(Request $request, Product $product)
    {
        //$category->load('products');
        if (config('setting.pricing') === true) {
            $attributes = $product->productAttributesHasQuantity->unique('attribute_id')->first();
            if ($attributes) {
                $product->price = $attributes->price;
            }
        }
        return view('root.products.quick-view', compact('product'));
    }

    public function search(Request $request)
    {
        $name = $request->input('searchName');
        $category = $request->input('categoryId');
//        return Product::find(1)->image->image_url(20,20);
        if (!is_null($name)) {
            if ($category) {
                $products = Product::query()->where('is_active', true)
                ->whereHas('categories', function ($q) use ($category) {
                    return $q->where('category_id', $category);
                })
                ->whereHas('translations', function ($q) use ($name) {
                    return $q->where('name', 'like', "%$name%");
                })->with('image')->orderByDesc('id')->take(8)->get();
            } else {
                $products = Product::query()->where('is_active', true)
                    ->whereHas('translations', function ($q) use ($name) {
                        return $q->where('name', 'like', "$name%");
                    })->with('image')->orderByDesc('id')->take(8)->get();
            }


            if ($request->expectsJson()) {
                // return $products;
                return response()->json($products);
            }
            return redirect()->route('products.index', ['searchName' => $request->input('searchName'), 'categoryId' => $request->input('categoryId')]);
        }
    }

    public function getStateCities($state_id)
    {
        $state = State::query()->find($state_id);

        if ($state) {
            return $state->cities;
        } else {
            return State::query()->first()->cities;
        }
    }
}
