<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\BundlesController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PermissionsGroupsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\MainSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', [StaterkitController::class, 'home'])->name('home');
Route::get('home', [StaterkitController::class, 'home'])->name('home');
// Route Components
Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');*/

Route::namespace('App\\Http\\Controllers\\Admin')->group(function () {
    Auth::routes([
        'login' => true,
        'logout' => true,
        'register' => false,
        'reset' => false,
        'confirm' => false,
        'verify' => false,
    ]);
});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('logs', [App\Http\Controllers\Admin\LogsController::class, 'index'])->name('logs');

    Route::group(['prefix'=>'/admin-profile'], function () {
        Route::get('/', [AdminUsersController::class,'edit_profile'])->name('profile');
        Route::put('/update', [AdminUsersController::class,'update_profile'])->name('update.profile');
    });

    Route::group(['middleware'=> 'role:admin'], function () {
        Route::resource('permissions', PermissionsController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('users', AdminUsersController::class);
        Route::resource('permission-group', PermissionsGroupsController::class)->except([
            'show',
        ]);
    });

    Route::group(['middleware'=> 'role:admin|graphics'], function () {
        Route::get('aboutUs-content', [App\Http\Controllers\Admin\AboutUsController::class,'aboutPage'])->name('aboutUsContent');
        Route::post('store-aboutUs-content', [App\Http\Controllers\Admin\AboutUsController::class,'store'])->name('aboutUsStore');

        Route::resource('page', App\Http\Controllers\Admin\PagesController::class);
        Route::get('page/page-activate/{id}', [PagesController::class,'pageActivate'])->name('page-activate');
    });

    Route::group(['middleware'=> 'role:admin|content'], function () {
        Route::resource('withdraws', App\Http\Controllers\Admin\WithdrawController::class);

        Route::get('categories/export', [App\Http\Controllers\Admin\CategoriesController::class, 'export'])->name('categories.export');
        Route::post('categories/import', [App\Http\Controllers\Admin\CategoriesController::class, 'import'])->name('categories.import');
        Route::get('categories/active/{id}', [App\Http\Controllers\Admin\CategoriesController::class, 'active'])->name('categories.active');
        Route::resource('categories', App\Http\Controllers\Admin\CategoriesController::class);

        Route::resource('customers', CustomersController::class);
        Route::get('customers/{user}/active', [App\Http\Controllers\Admin\CustomersController::class, 'active'])->name('customers.active');
        Route::get('customers/{user}/verify', [App\Http\Controllers\Admin\CustomersController::class, 'verify'])->name('customers.verify');

        Route::get('subscribers/sendOffres', [App\Http\Controllers\Admin\SubscribersController::class, 'sendProductsOffers'])->name('customers.sendOffres');
        Route::resource('subscribers', SubscribersController::class);

        Route::get('manufacturers/export', [App\Http\Controllers\Admin\ManufacturersController::class, 'export'])->name('manufacturers.export');
        Route::post('manufacturers/import', [App\Http\Controllers\Admin\ManufacturersController::class, 'import'])->name('manufacturers.import');
        Route::resource('manufacturers', ManufacturersController::class);

        Route::resource('dealsection', App\Http\Controllers\Admin\DealSectionController::class);
        Route::get('dealsection/get_products/{id}', [App\Http\Controllers\Admin\DealSectionController::class, 'get_products']);

        Route::get('brands/export', [App\Http\Controllers\Admin\BrandsController::class, 'export'])->name('brands.export');
        Route::post('brands/import', [App\Http\Controllers\Admin\BrandsController::class, 'import'])->name('brands.import');
        Route::resource('brands', App\Http\Controllers\Admin\BrandsController::class);

        Route::get('bundles/activation/{id}', [App\Http\Controllers\Admin\BundlesController::class, 'activation'])->name('bundles.active');
        Route::get('product/activation/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'activation'])->name('products.active');

        Route::post('attributes-product', [App\Http\Controllers\Admin\ProductsController::class, 'getProductAttributesAjax'])->name('product.attributes');
        Route::post('attributes-current-product', [App\Http\Controllers\Admin\ProductsController::class, 'getCurrentProductAttributesAjax'])->name('product.attributes');
        Route::get('pattributes', [App\Http\Controllers\Admin\ProductsController::class, 'getProductAttributes'])->name('products.attributes');

        Route::get('inventories/{inventory}/products/create', [App\Http\Controllers\Admin\InventoryProductsController::class, 'create'])->name('inventory.products.create');
        Route::post('inventories/{inventory}/products', [App\Http\Controllers\Admin\InventoryProductsController::class, 'store'])->name('inventory.products.store');
        Route::delete('inventories/{inventory}/products/{inventory_product}', [App\Http\Controllers\Admin\InventoryProductsController::class, 'destroy'])->name('inventory.products.destroy');
        Route::get('inventories/{inventory}/products', [App\Http\Controllers\Admin\InventoryProductsController::class, 'index'])->name('inventory.products');
        Route::resource('inventories', App\Http\Controllers\Admin\InventoriesController::class);

        Route::post('translations/data', [App\Http\Controllers\Admin\TranslationsController::class, 'data'])->name('translations.data');
        Route::resource('translations', App\Http\Controllers\Admin\TranslationsController::class);
        Route::get('modules/{id}/active/{active}', [App\Http\Controllers\Admin\ModulesController::class, 'active'])->name('modules.active');

        Route::resource('attributes', App\Http\Controllers\Admin\AttributesController::class);
        Route::resource('attrGroups', App\Http\Controllers\Admin\AttributeGroupsController::class);
        Route::get('/attribute-product/check-before-delete{id?}', [App\Http\Controllers\Admin\ProductsController::class,'attributeBeforeDelete'])->name('att-product-before-delete');
        Route::get('/attrGroup_activation/{id}', [App\Http\Controllers\Admin\AttributeGroupsController::class, 'activate'])->name('attribute.activation');

//        Route::get('/attrGroup_activation/{$id}',function (){
//            return 'active';
//        })->name('attrGroup.activation');

        Route::resource('options', App\Http\Controllers\Admin\OptionsController::class);
        Route::post('options/values', [App\Http\Controllers\Admin\OptionsController::class, 'getValuesByOptionId'])->name('options.values');
        Route::get('main_setting', [App\Http\Controllers\Admin\MainSettingController::class, 'create'])->name('setting.main_setting');
        Route::post('main_setting', [App\Http\Controllers\Admin\MainSettingController::class, 'store'])->name('setting.main_setting_post');
        Route::resource('setting', App\Http\Controllers\Admin\SettingController::class);
        Route::resource('packages', App\Http\Controllers\Admin\PackagesController::class);
        Route::resource('countries', App\Http\Controllers\Admin\CountriesController::class);
        Route::post('states/data', [App\Http\Controllers\Admin\StatesController::class, 'data'])->name('states.data');
        Route::resource('states', App\Http\Controllers\Admin\StatesController::class);

        Route::resource('branch', App\Http\Controllers\Admin\BranchController::class)->except(['show']);
        Route::get('branch/activation/{id}', [App\Http\Controllers\Admin\BranchController::class,'activation'])->name('branch.activation');

        Route::post('cities/data', [App\Http\Controllers\Admin\CitiesController::class, 'data'])->name('cities.data');
        Route::resource('cities', App\Http\Controllers\Admin\CitiesController::class);
        Route::post('locations/data', [App\Http\Controllers\Admin\LocationsController::class, 'data'])->name('locations.data');
        Route::resource('locations', App\Http\Controllers\Admin\LocationsController::class);
    });




//    Route::get('seller/{id}', [App\Http\Controllers\Admin\SellerController::class, 'show_profile'])->name("showSeller");
//
//    Route::post('seller/update/{id}', [App\Http\Controllers\Admin\SellerController::class, 'edit_profile'])->name("editSeller");




    Route::group(['middleware'=>'role:admin|content|customer_service'], function () {

//        Route::post('orders/{order}', [App\Http\Controllers\Admin\OrdersController::class, 'save']);
//        Route::get('orders', [App\Http\Controllers\Admin\OrdersController::class, 'index']);

        if (config('setting.pricing')) {
            Route::resource('orders', App\Http\Controllers\Admin\OrdersController::class);
            Route::post('update-prices-orders/{id}', [App\Http\Controllers\Admin\OrdersController::class,'updateOrderPrice'])->name('update-order');
            Route::get('cancelled_orders', [App\Http\Controllers\Admin\OrdersController::class, 'cancelled_orders'])->name('orders.cancelled');
        } else {
            Route::resource('orders', App\Http\Controllers\Admin\PricesOrderController::class);
            Route::post('update-prices-orders/{id}', [App\Http\Controllers\Admin\PricesOrderController::class,'updateOrderPrice'])->name('update-order');
            Route::get('cancelled_orders', [App\Http\Controllers\Admin\PricesOrderController::class, 'cancelled_orders'])->name('orders.cancelled');
        }

//        Route::get('view-price-orders/{id}', [App\Http\Controllers\Admin\OrdersController::class,'viewOrderPrice'])->name('view-order-price');

        Route::get('product/attribute/{product}', [App\Http\Controllers\Admin\ProductsController::class, 'attribute_index'])->name('products.attribute.index');
        Route::post('product/attribute/{product}/store', [App\Http\Controllers\Admin\ProductsController::class, 'attribute_store'])->name('products.attribute.store');
        Route::delete('product/attribute/{product}/delete/{attribute}', [App\Http\Controllers\Admin\ProductsController::class, 'attribute_delete'])->name('products.attribute.destroy');
        Route::put('product/attribute/{product}/update/{attribute}', [App\Http\Controllers\Admin\ProductsController::class, 'attribute_update'])->name('products.attribute.update');


        Route::get('products/export', [App\Http\Controllers\Admin\ProductsController::class, 'export'])->name('products.export');
        Route::get('products/import', [App\Http\Controllers\Admin\ProductsController::class, 'importShow'])->name('products.import.show');
        Route::post('products/import', [App\Http\Controllers\Admin\ProductsController::class, 'import'])->name('products.import');
        Route::post('products/data/{kind?}', [App\Http\Controllers\Admin\ProductsController::class, 'data'])->name('products.data');
        Route::get('products/{id}/enddeal', [App\Http\Controllers\Admin\ProductsController::class, 'enddeal'])->name('products.enddeal');
        Route::get('products/onsale', [App\Http\Controllers\Admin\ProductsController::class, 'onSale'])->name('products.onsale');
        Route::get('products/hot', [App\Http\Controllers\Admin\ProductsController::class, 'onHot'])->name('products.hot');
        Route::get('products/combo', [App\Http\Controllers\Admin\ProductsController::class, 'comboProducts'])->name('products.combo');
        Route::resource('products', App\Http\Controllers\Admin\ProductsController::class);
        Route::get('product/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'findone']);

        Route::get('show-bundle-order/{id}/{bundle_id}', [App\Http\Controllers\Admin\OrdersController::class, 'show_bundle'])->name('order.bundle.show');
        Route::post('transactions/data', [App\Http\Controllers\Admin\TransactionController::class, 'data'])->name('transactions.data');
        Route::resource('transactions', App\Http\Controllers\Admin\TransactionController::class);
        Route::post('reviews/data', [App\Http\Controllers\Admin\ReviewsController::class, 'data'])->name('reviews.data');
        // Route::resource('reviews', App\Http\Controllers\Admin\ReviewsController::class);
        Route::get('reviews', [App\Http\Controllers\Admin\ReviewsController::class, 'index'])->name('reviews.index');
        Route::get('reviews/approve', [App\Http\Controllers\Admin\ReviewsController::class, 'approve'])->name('reviews.approve');
        Route::get('reviews/disapprove', [App\Http\Controllers\Admin\ReviewsController::class, 'disapprove'])->name('reviews.disapprove');
        // reports
        Route::get('report/orders', [App\Http\Controllers\Admin\ReportsController::class, 'ordersReportTable'])->name('report.orders');
        Route::post('report/orders', [App\Http\Controllers\Admin\ReportsController::class, 'ordersReportResults'])->name('report.orders.results');
        Route::get('bulk_image_upload', [App\Http\Controllers\Admin\BulkImagesController::class, 'index'])->name('images.index');
        Route::post('bulk_image_upload', [App\Http\Controllers\Admin\BulkImagesController::class, 'store'])->name('images.post');

        Route::post('approve-return', [App\Http\Controllers\Admin\ReturnOrdersController::class, 'approve_return']);
        Route::post('disapprove-return', [App\Http\Controllers\Admin\ReturnOrdersController::class, 'disapprove_return']);

        // Points
        Route::post('points/data', [App\Http\Controllers\Admin\PointController::class, 'data'])->name('points.data');
        Route::resource('points', App\Http\Controllers\Admin\PointController::class);
        Route::post('points', [App\Http\Controllers\Admin\PointController::class, 'index_post'])->name('points.index_post');

        // Complaints
        Route::get('complaints/{user_id}', [App\Http\Controllers\Admin\ComplaintController::class, 'chat']);
        Route::post('complaints/{user_id}', [App\Http\Controllers\Admin\ComplaintController::class, 'chat_store']);
        Route::post('complaints/data', [App\Http\Controllers\Admin\ComplaintController::class, 'data'])->name('complaints.data');

        Route::resource('complaints', App\Http\Controllers\Admin\ComplaintController::class);
//
        Route::get('complaints/newChat', [App\Http\Controllers\Admin\CathController::class, 'newChat'])->name("complaints.newChat");
        Route::post('complaint/postNew', [App\Http\Controllers\Admin\CathController::class, '_newComplaint'])->name('complaints.postNew');

        Route::get("/new-chat", [App\Http\Controllers\Admin\CathController::class, 'newChat'])->name("complaints.newChat");
        Route::get("/get-seller", [App\Http\Controllers\Admin\CathController::class, 'getSeller'])->name("complaints.getSeller");
        Route::resource('return_reasons', App\Http\Controllers\Admin\ReturnReasonController::class);
        Route::resource('returns', App\Http\Controllers\Admin\ReturnOrdersController::class);

        Route::post('modules/order', [App\Http\Controllers\Admin\ModulesController::class, 'saveOrder'])->name('modules.order');
        Route::resource('modules', App\Http\Controllers\Admin\ModulesController::class);

        Route::resource('shipping_companies', App\Http\Controllers\Admin\ShippingCompanyController::class);
        Route::post('shipping_zones/data', [App\Http\Controllers\Admin\ShippingZoneController::class, 'data'])->name('shipping-zones.data');
        Route::resource('shipping_zones', App\Http\Controllers\Admin\ShippingZoneController::class);
        Route::post('shipping_requests/data', [App\Http\Controllers\Admin\ShippingRequestController::class, 'data'])->name('shipping-requests.data');
        Route::resource('shipping_requests', App\Http\Controllers\Admin\ShippingRequestController::class);
        Route::get('shipping_requests/proccess/{id}', [App\Http\Controllers\Admin\ShippingRequestController::class, 'proccess'])->name('shipping_requests.proccess');
        Route::get('shipping_requests/delivered/{id}', [App\Http\Controllers\Admin\ShippingRequestController::class, 'delivered'])->name('shipping_requests.delivered');
        // Route::resource('orders/reports','AdminUsersController');
        Route::get('shipping-request/{company}/{order}/{orderline}', [App\Http\Controllers\Admin\ShippingRequestController::class, 'check']);

        Route::resource('contact-messages', App\Http\Controllers\Admin\ContactUsController::class);
    });

    Route::group(['middleware'=>'role:admin|merchandising'], function () {
        Route::resource('coupons', App\Http\Controllers\Admin\CouponsController::class);
        Route::resource('promotions', App\Http\Controllers\Admin\PromotionsController::class);
    });

    Route::get('bundles/products', [App\Http\Controllers\Admin\BundlesController::class, 'products'])->name('bundles.products');
    Route::post('bundles/data', [App\Http\Controllers\Admin\BundlesController::class, 'data'])->name('bundles.data');
    Route::resource('bundles', BundlesController::class);
    // Route::get('combo/products',[App\Http\Controllers\Admin\ComboController::class, 'products'])->name('combo.products');
    // Route::get('combo/categories',[App\Http\Controllers\Admin\ComboController::class, 'categories'])->name('combo.categories');
    // Route::post('combo/data',[App\Http\Controllers\Admin\ComboController::class, 'data'])->name('combo.data');
    // Route::resource('combo','ComboController');



    // Shipping Routes
    //Route::post('shipping_companies/data',[App\Http\Controllers\Admin\ShippingCompanyController::class, 'data'])->name('shipping-companies.data');

    // Shipping Request shipping-request/'+company+'/'+order+'/'+orderline


    // SLIDER CONTENT
    Route::resource('slider', SliderController::class);
    Route::get('slider-activate/{slider}', [SliderController::class, 'activation'])->name('sliderActivation');
    Route::get('productsSelector/{product}')->name('productsSelector');
    // Priority
    Route::get('priority', [App\Http\Controllers\Admin\PriorityController::class, 'index'])->name('priority');
    Route::get('priority/create', [App\Http\Controllers\Admin\PriorityController::class, 'create']);
    Route::post('priority/store', [App\Http\Controllers\Admin\PriorityController::class, 'store'])->name('priority.store');
    Route::get('priority/edit/{id}', [App\Http\Controllers\Admin\PriorityController::class, 'edit'])->name('priority.edit');
    Route::post('priority/update/{id}', [App\Http\Controllers\Admin\PriorityController::class, 'update'])->name('priority.update');
    Route::post('priority/update-all', [App\Http\Controllers\Admin\PriorityController::class, 'update_all'])->name('priority.updateall');
    Route::post('priority/toggole', [App\Http\Controllers\Admin\PriorityController::class, 'toggole'])->name('priority.toggole');

    //****

    Route::resource('seller', App\Http\Controllers\Admin\SellerController::class)
        ->except(['show', 'create', 'store', 'destroy']);
    Route::get('seller/activation/{id}', [App\Http\Controllers\Admin\SellerController::class,'activation'])->name('seller.activation');
});



//Route::get('try-roles', function (){
////    return \auth()->guard('admin')->user()->hasAnyRole('merchandising')?'has':'no';
//    return \auth()->guard('admin')->user()->getRoleNames();
//})->middleware('role:merchandising');
