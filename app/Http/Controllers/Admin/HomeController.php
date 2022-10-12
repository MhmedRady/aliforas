<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth\Seller;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\PriceQuoteOrder;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller\Branch;
use App\Models\User;

class HomeController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $productsCount = Product::query()->count();
        $usersCount = User::query()->where('is_admin', 0)->where('is_seller', 0)->count();

        $reviews = Review::orderBy('id', 'desc')->limit(5)->get();

        $companies = Manufacturer::query()->orderBy('id', 'desc')
            ->limit(5)->get();
        $companiesCount = Manufacturer::query()->count();
        $sellersCount = Seller::query()->count();
        $branchesCount = Branch::query()->count();
//        return $companies->where('id',2)->first()->products->count();
        if (config('setting.pricing') === true) {
            $orders_recent = Order::orderBy('id', 'desc')->limit(10)->get();
            $ordersCount = Order::query()->count();
        } else {
            $orders_recent = PriceQuoteOrder::query()->orderBy('id', 'desc')->limit(10)->get();
            $ordersCount = PriceQuoteOrder::query()->count();
        }
        $breadcrumbs = [
            ['link' => route('admin.home'), 'name' => 'Dashboard']
        ];
        return view('admin.content.home', compact([
            'breadcrumbs', 'usersCount', 'ordersCount', 'sellersCount', 'branchesCount', 'productsCount', 'reviews', 'orders_recent', 'companies', 'companiesCount'
        ]));
    }
}
