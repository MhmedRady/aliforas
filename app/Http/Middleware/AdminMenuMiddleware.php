<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminMenuMiddleware
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
        $pricing = config('setting.pricing') === true;

        $menuData = [
            'menu' => [
                ['url' => route('admin.home'), 'name' => 'Dashboard', 'icon' => 'home', 'slug' => 'admin.home', 'roles'=> 'all'],
                    [
                        'name' => 'Users Management', 'icon' => 'users', 'roles' => 'admin',
                        /*'badge' => 5, 'badgeClass' => 'badge rounded-pill badge-light-danger ms-auto me-1',*/
                        'submenu' => [
                            ['url' => route('admin.users.index'), 'name' => 'Admins', 'slug' => 'admin.users.'],
                            ['url' => route('admin.permission-group.index'), 'name' => 'Permissions Groups', 'slug' => 'admin.permission-group.'],
                            ['url' => route('admin.permissions.index'), 'name' => 'Permissions', 'slug' => 'admin.permissions.'],
                            ['url' => route('admin.roles.index'), 'name' => 'Roles', 'slug' => 'admin.roles.'],
                        ]
                    ],
                [
                    'name' => 'Client Management', 'icon' => 'users', 'roles' => ['admin', 'content'],
                    'submenu' => [
                        ['url' => route('admin.customers.index'), 'name' => 'Customers', 'slug' => 'admin.customers.'],
                        $pricing ? ['url' => route('admin.seller.index'), 'name' => 'Sellers', 'slug' => 'admin.sellers.'] : null,

                        //['url' => route('admin.contactuser'), 'name' => 'ContactUser', 'slug' => 'admin.contactuser'],

                        ['name'=>'Contact Messages','slug'=>'admin.contact_messages', 'url'=>route('admin.contact-messages.index')],
                        ['name'=>'AboutUs Content','slug'=>'admin.about_us', 'url'=>route('admin.aboutUsContent')],

                        $pricing ? ['url' => route('admin.subscribers.index'), 'name' => 'Subscribers', 'slug' => 'admin.subscribers.'] : null,
                        ['url' => route('admin.reviews.index'), 'name' => 'Reviews', 'slug' => 'admin.reviews.'],
                        $pricing ? ['url' => route('admin.complaints.index'), 'name' => 'Complaints', 'slug' => 'admin.complaints.'] : null,
                    ]
                ],
                [
                    'name' => 'Catalog', 'icon' => 'grid', 'roles' => ['admin','content'],
                    'submenu' => [
                        ['url' => route('admin.brands.index'), 'name' => 'Brands', 'slug' => 'admin.brands.'],
                        ['url' => route('admin.manufacturers.index'), 'name' => 'Manufacturers', 'name'=>'Companies', 'slug' => 'admin.manufacturers.'],
                        ['url' => route('admin.categories.index'), 'name' => 'Categories', 'slug' => 'admin.categories.'],
                        $pricing?['url' => route('admin.branch.index'), 'name' => 'Branches', 'slug' => 'admin.branches.']:null,

                        ['url' => route('admin.slider.index'), 'name' => 'Home Slider', 'slug' => 'admin.Slider.'],

//                        ['url' => route('admin.images.index'), 'name' => 'Bulk Image Upload', 'slug' => 'admin.images.'],
//                        ['url' => route('admin.dealsection.index'), 'name' => 'Deal Sections', 'slug' => 'admin.dealsection.'],
                    ]
                ],
                $pricing ? [
                    'name' => 'Products', 'icon' => 'archive', 'roles' => ['admin','customer_service'],
                    'submenu' => [
                        ['url' => route('admin.products.index'), 'name' => 'All Products', 'slug' => 'admin.products.index'],
                        ['url' => route('admin.products.onsale'), 'name' => 'On Sale Products', 'slug' => 'admin.products.onsale'],
                        ['url' => route('admin.products.hot'), 'name' => 'Hot Products', 'slug' => 'admin.products.hot'],
//                        ['url' => route('admin.bundles.index'), 'name' => 'Bundles', 'slug' => 'admin.bundles.'],
                        ['url' => route('admin.attrGroups.index'), 'name' => 'Attribute Groups', 'slug' => 'admin.attrGroups.'],
                        ['url' => route('admin.attributes.index'), 'name' => 'Attributes', 'slug' => 'admin.attributes.'],
                    ]
                ] : [
                    'name' => 'Products', 'icon' => 'archive', 'roles' => ['admin','customer_service'],
                    'submenu' => [
                        ['url' => route('admin.products.index'), 'name' => 'All Products', 'slug' => 'admin.products.index'],
                        ['url' => route('admin.products.onsale'), 'name' => 'On Sale Products', 'slug' => 'admin.products.onsale'],
                        ['url' => route('admin.products.hot'), 'name' => 'Hot Products', 'slug' => 'admin.products.hot'],
                    ]
                ],
//                $pricing ?
                    [
                    'name' => 'Orders', 'icon' => 'shopping-cart', 'roles' => ['admin','content','customer_service'],
                    'submenu' => [
                        ['url' => route('admin.orders.index'), 'name' => 'All Orders', 'slug' => 'admin.orders.'],
                        ['url' => route('admin.orders.cancelled'), 'name' => 'Cancelled Orders', 'slug' => 'admin.orders2.cancelled'],
//                        ['url' => route('admin.transactions.index'), 'name' => 'Transactions', 'slug' => 'admin.transactions.'],
                        //['url' => route('admin.shipping_requests.index'), 'name' => 'Shipping Requests', 'slug' => 'admin.shipping_requests.'],
                        //['url' => route('admin.withdraws.index'), 'name' => 'Withdraws', 'slug' => 'admin.withdraws.'],
                        //['url' => route('admin.returns.index'), 'name' => 'Return Orders', 'slug' => 'admin.returns.'],
                        //['url' => route('admin.return_reasons.index'), 'name' => 'Return Reasons', 'slug' => 'admin.return_reasons.'],
                    ],
//                ] ,
//                    : [
//                    'name' => 'Orders', 'icon' => 'shopping-cart', 'roles' => ['admin','content','customer_service'],
//                    'submenu' => [
//                        ['url' => route('admin.orders.index'), 'name' => 'All Orders', 'slug' => 'admin.orders.'],
//                        ['url' => route('admin.orders.cancelled'), 'name' => 'Cancelled Orders', 'slug' => 'admin.orders.cancelled'],
//                    ]
                ],

                $pricing ? [
                    'name' => 'Shipping Setting', 'icon' => 'users', 'roles' => ['admin','content','customer_service'],
                    'submenu' => [
                        ['url' => route('admin.shipping_companies.index'), 'name' => 'Companies', 'slug' => 'admin.shipping_companies.'],
                        ['url' => route('admin.shipping_zones.index'), 'name' => 'Zones', 'slug' => 'admin.shipping_zones.'],
                    ]
                ] : null,
//                $pricing ? [
//                    'name' => 'Marketing', 'icon' => 'users', 'roles'=> ['admin', 'merchandising'],
//                    'submenu' => [
//                        ['url' => route('admin.coupons.index'), 'name' => 'Coupons', 'slug' => 'admin.coupons.'],
//                        ['url' => route('admin.promotions.index'), 'name' => 'Promotions', 'slug' => 'admin.promotions.'],
//                    ]
//                ] : null,
                [
                    'name' => 'Destination', 'icon' => 'users', 'roles' => ['admin','content'],
                    'submenu' => [
                        ['url' => route('admin.countries.index'), 'name' => 'Countries', 'slug' => 'admin.countries.'],
                        ['url' => route('admin.states.index'), 'name' => 'States', 'slug' => 'admin.states.'],
                        ['url' => route('admin.cities.index'), 'name' => 'Cities', 'slug' => 'admin.cities.'],
                    ]
                ],
                /*[

                    'url' => route('admin.modules.index'), 'icon' => 'command',
                    'name' => 'Modules', 'slug' => 'admin.modules.index'
                ],*/
                [
                    'name' => 'Settings', 'icon' => 'users', 'roles' => ['admin','content','customer_service'],
                    'submenu' => [
//                        ['url' => route('admin.translations.index'), 'name' => 'Translations', 'slug' => 'admin.translations.'],
                        ['url' => route('admin.setting.main_setting'), 'name' => 'Main Setting', 'slug' => 'admin.setting.main_setting'],
//                        $pricing ? ['url' => route('admin.priority'), 'name' => 'Offer Setting', 'slug' => 'admin.priority'] : null,
                        /*['url' => route('admin.setting.index'), 'name' => 'Setting', 'slug' => 'admin.setting.index'],*/
                    ]
                ],
                [
                    'url' => route('admin.page.index'), 'icon' => 'command', 'roles' => ['admin','graphics'],
                    'name' => 'Pages', 'slug' => 'admin.page.index'
                ],
//                [
//
//                    'url' => route('admin.logs'), 'icon' => 'command', 'roles' => ['admin'],
//                    'name' => 'Dashboard Logs', 'slug' => 'admin.logs'
//                ],
            ]
        ];
        View::share('verticalMenuData', $menuData);
        View::share('horizontalMenuData', $menuData);
        return $next($request);
    }
}
