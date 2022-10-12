<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SellerMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @noinspection AllyPlainPhpInspection
     */
    public function handle(Request $request, Closure $next)
    {

        $menuData = [
            'menu' => [
                ['url' => route('seller.home'), 'name' => __('layouts.home'), 'icon' => 'home', 'slug' => 'seller.home'],
                ['url' => route('seller.branch.index'), 'name' => __('layouts.branches'), 'icon' => 'map-pin', 'slug' => 'seller.branches'],
                ['url' => route('seller.complaints.index'), 'name' => __('layouts.messages'), 'icon' => 'inbox', 'slug' => 'seller.complaints'],
                [
                    'name' => __('layouts.allProducts'), 'icon' => 'archive',
                    'submenu' => [
                        ['url' => route('seller.products.index'), 'name' => __('layouts.allProducts'), 'slug' => 'seller.products.index'],
                        ['url' => route('seller.products.on_sale'), 'name' => __('layouts.on_sale'), 'slug' => 'seller.products.on_sale'],
                        ['url' => route('seller.products.is_hot'), 'name' => __('layouts.is_hot'), 'slug' => 'seller.products.is_hot'],
                    ]
                ],

                [
                    'name' => __('layouts.orders'), 'icon' => 'shopping-cart',
                    'submenu' => [
                        ['url' => route('seller.orders.index'), 'name' => __('layouts.all') .' '. __('layouts.orders'), 'slug' => 'seller.orders.index'],
                        ['url' => route('seller.orders2.cancelled'), 'name' =>  __('layouts.canceledOrders'), 'slug' => 'seller.orders2.cancelled'],
//                        ['url' => route('seller.orders.canceled'), 'name' => __('layouts.canceledOrders'), 'slug' => 'seller.orders.canceled'],

//                        ['url' => route('seller.transactions.index'), 'name' => 'Transactions', 'slug' => 'admin.transactions.'],
                        //['url' => route('admin.shipping_requests.index'), 'name' => 'Shipping Requests', 'slug' => 'admin.shipping_requests.'],
                        //['url' => route('admin.withdraws.index'), 'name' => 'Withdraws', 'slug' => 'admin.withdraws.'],
                        //['url' => route('admin.returns.index'), 'name' => 'Return Orders', 'slug' => 'admin.returns.'],
                        //['url' => route('admin.return_reasons.index'), 'name' => 'Return Reasons', 'slug' => 'admin.return_reasons.'],
                    ]
                ],
            ]
        ];
        View::share('verticalMenuData', $menuData);
        View::share('horizontalMenuData', $menuData);
        return $next($request);
    }
}
