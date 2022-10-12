<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\MainSetting;
use App\Models\Page;
use App\Models\AboutUs;
use App\Models\DealSection;
use App\Models\Module;
use App\Models\Priority;
use App\Models\Product;
use App\Models\Seller\Branch;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['seller.panels.navbar'], function ($view) {
            $nBranches = Branch::query()->where('shown', false)->get();
            $messages  = Complaint::query()->where('to', auth()->guard('seller')->id())->where('seller_read', false)->orderByDesc('id')->groupBy('from')->latest()->get();

            $notifications = $messages->merge($nBranches)->sortByDesc('updated_at');

            $view->with([
                'notifications' => $notifications
            ]);
        });

        View::composer(['root.layouts.header'], function ($view) {
            $locale = App::getLocale();
            $categories = Category::whereIsActive(true)->has('products')/*->whereNull('parent_id')*/->with('children')->get();

            $view->with([
                'categories' => $categories
            ]);
        });

        View::composer(['root.layouts.footer'], function ($view) {
            $mainSetting = MainSetting::query()->get();

            $view->with([
                'mainSetting' => $mainSetting,
            ]);
        });

        View::composer(['root.layouts.app'], function ($view) {
            $customPages = Page::query()->where('is_active',1)->get();
            $aboutUs = AboutUs::query()->where('is_active',1)->get();
            $view->with([
                'aboutUs' => $aboutUs,
                'customPages' => $customPages,
            ]);
        });

        View::composer(['layouts.component._header', 'layouts.component._sidbar', 'layouts.component._category', 'layouts.app', 'website.components.header'], function ($view) {
            $locale = App::getLocale();
            $categories = Category::whereIsActive(true)->whereParentId(0)->get();

            $allCategories = Category::whereIsActive(true)->get();
            $categoryHeader = Category::whereIsActive(true)->whereInHeader(1)->get();
            $pageHeader = Page::whereIsActive(1)->whereShowHeader(1)->get();
            $pageFooter = Page::whereIsActive(1)->whereShowFooter(1)->get();
            session()->forget('products.cart.null');
            $cart = session()->get('products.cart');
            $cart_counter = 0;
            if ($cart)
                foreach ($cart as $c) {
                    $cart_counter += $c[0]['quantity'] ? $c[0]['quantity'] : 1;
                }
            $view->with(['locale' => $locale, 'categories' => $categories, 'allcategories' => $allCategories, 'cart_counter' => $cart_counter,
                'page_header' => $pageHeader, 'page_footer' => $pageFooter, 'category_header' => $categoryHeader]);
        });

        View::composer('website.layouts.master', function ($view) {
            $locale = Lang::getLocale();

            if (Module::whereIsActive(1)->where('place', 'home_slider')->count() > 0) {
                $data = Module::whereIsActive(1)->where('place', 'home_slider')->get()->first()->content;
                $slider = json_decode($data)->slide;
            } else {
                $slider = null;
            }

            if (Category::whereIsActive(true)->whereParentId(0)->count() > 0) {
                $categories = Category::whereIsActive(true)->whereParentId(0)->orderBy('arrange', 'asc')->get();
                $categoryHeader = Category::whereIsActive(true)->whereInHeader(1)->orderBy('arrange', 'asc')->get();
            } else {
                $categories = null;
                $categoryHeader = null;
            }


            $pageHeader = Page::whereIsActive(1)->whereShowHeader(1)->get();
            if (Module::whereIsActive(1)->where('place', 'home_special_products')->count() > 0) {
                $special = Module::whereIsActive(1)->where('place', 'home_special_products')->get()->first()->content;
                $specialProducts = json_decode($special);
            } else {
                $specialProducts = null;
            }


            if ($home_categories_products = Module::whereIsActive(1)->where('place', 'home_categories_products')->get()->first()) {
                $home_categories_products = $home_categories_products->content;
                $homeCategories = json_decode($home_categories_products)->categories;
            } else {
                $homeCategories = null;
            }

            if (Module::whereIsActive(1)->where('place', 'home_product_banner')->count() > 0) {
                $home_product_banner = Module::whereIsActive(1)->where('place', 'home_product_banner')->get()->first()->content;
                $bigSale = json_decode($home_product_banner);
            } else {
                $bigSale = null;
            }

            if (Module::whereIsActive(1)->where('place', 'home_two_cards')->count() > 0) {
                $home_two_cards = Module::whereIsActive(1)->where('place', 'home_two_cards')->get()->first()->content;
                $homeTwoCards = json_decode($home_two_cards);
            } else {
                $homeTwoCards = null;
            }

            if (Module::whereIsActive(1)->where('place', 'home_circle_categories')->count() > 0) {
                $home_circle_categories = Module::whereIsActive(1)->where('place', 'home_circle_categories')->get()->first()->content;
                $homeCircleCategories = json_decode($home_circle_categories)->categories;
            } else {
                $homeCircleCategories = null;
            }

            $productsHasSale = Product::where('is_hot', 1)->where('is_active', 1)->where('stock', '>', 0)->where('hot_ends_at', '>', now())->orderBy('id', 'DESC')->limit(5)->get();

            $productsHasSale_ended = Product::where('is_hot', 1)->where('is_active', 1)->where('stock', '>', 0)->where('hot_ends_at', '<', now())->orderBy('id', 'DESC')->limit(5)->get();
            foreach ($productsHasSale_ended as $product) {
                $product->is_hot = 0;
                $product->price = $product->hot_price;
                $product->save();
            }
            $bundles_ended = Product::where('is_bundle', 1)->where('is_active', 1)->where('bundle_end', '<', now())->orderBy('id', 'DESC')->get();
            foreach ($bundles_ended as $product) {
                $product->is_active = 0;
                $product->save();
            }

            $pageFooter = Page::whereIsActive(1)->whereShowFooter(1)->get();
            $now = date('Y-m-d');
            $dealsectionHeader = DealSection::where('is_active', 1)->where('end_date', '>', $now)->get();

            $discount_priority = [
                'combo_order_id' => optional(Priority::where('name', 'combo')->first())->order_id,
                'on_sale_order_id' => optional(Priority::where('name', 'on_sale')->first())->order_id,
                'hot_order_id' => optional(Priority::where('name', 'hot')->first())->order_id,
                'promotion_order_id' => optional(Priority::where('name', 'promotion')->first())->order_id,
                'bundle_order_id' => optional(Priority::where('name', 'bundle')->first())->order_id,
                'coupon_order_id' => optional(Priority::where('name', 'coupon')->first())->order_id,
            ];

            $view->with([
                'locale' => $locale,
                'slider' => $slider,
                'categories' => $categories,
                'category_header' => $categoryHeader,
                'dealsection_header' => $dealsectionHeader,
                'page_header' => $pageHeader,
                'specialProducts' => $specialProducts,
                'homeCategories' => $homeCategories,
                'productsHasSale' => $productsHasSale,
                'bigSale' => $bigSale,
                'homeTwoCards' => $homeTwoCards,
                'homeCircleCategories' => $homeCircleCategories,
                'page_footer' => $pageFooter,
                'discount_priority' => $discount_priority,
            ]);
        });
    }
}
