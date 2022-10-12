<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Auth::routes();

Route::get('/verify-email/{email}', [App\Http\Controllers\HomeController::class, 'verify_email']);

Route::get('/reset-password/{email}', [App\Http\Controllers\HomeController::class, 'reset_password']);
Route::post('/reset-password/{user}', [App\Http\Controllers\HomeController::class, 'reset_pwd']);

Route::post('/create-account', [App\Http\Controllers\HomeController::class, 'createAccount'])->name('create_account');

Route::any('paymentTest', [App\Http\Controllers\test\TestController::class, 'index']);
Route::any('payfort', [App\Http\Controllers\test\TestController::class, 'payfort']);
Route::any('payment', [App\Http\Controllers\test\TestController::class, 'payment']);

Route::any('payfortFinish', [App\Http\Controllers\PayfortController::class, 'finish']);
Route::any('payfortSave', [App\Http\Controllers\PayfortController::class, 'save'])->name('payfortSave');
Route::any('payfortToken', [App\Http\Controllers\PayfortController::class, 'getToken']);
Route::any('payfortOperation', [App\Http\Controllers\PayfortController::class, 'getOperation']);
Route::any('payfortSaveOrder', [App\Http\Controllers\PayfortController::class, 'getOrderSession']);

Route::get('image/{type}/{filename}', [App\Http\Controllers\ImageController::class, 'index'])
    ->where('type', 'manufacturer|brand|product|module|category')
    ->name('image');
Route::get('images/{type}/{filename}', [App\Http\Controllers\ImageController::class, 'index'])
    ->where('type', 'manufacturer|brand|product|module|category')
    ->name('images');

Route::get('thumb/{type}/{w}x{h}/{filename}', [App\Http\Controllers\ImageController::class, 'thumb'])
    ->where('w', '5|39|50|64|100|150|300|400|275|250|768|84')
    ->where('h', '5|39|50|64|100|150|300|280|180|250|988|120')
    ->where('type', 'manufacturer|brand|module|product|category')
    ->name('thumb');

Route::group([
    'prefix' => 'big-boss',
//     'as'        => 'admin',
],
    function () {


    });


// Bulk Image Uploads

//contactuser
Route::get('/big-boss/contactuser', [App\Http\Controllers\Admin\ContactUsController::class, 'show']);
Route::get('/sitemap', [App\Http\Controllers\SitemapController::class, 'sitemap']);
Route::get('/data/cities', [App\Http\Controllers\DataController::class, 'getCitiesByCountryId']);

/*==================================================Start Seller==========================================================================*/


Route::group([
    "prefix" => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
],
    function () {
        Route::group(['prefix' => '/seller',
            //'as'=> 'admin',
        ], function () {

            Route::get('/', [App\Http\Controllers\Seller\SellerLoginController::class, 'showSellerLoginForm']);
            Route::get('/login', [App\Http\Controllers\Seller\SellerLoginController::class, 'showSellerLoginForm'])->name('seller.login');
            Route::post('/setLogin', [App\Http\Controllers\Seller\SellerLoginController::class, 'SellerLogin'])->name("seller.postLogin");
            Route::get('/logout', [App\Http\Controllers\Seller\SellerLoginController::class, 'SellerLogout'])->name('seller.logout');

            Route::get('/create', [App\Http\Controllers\Seller\SellerController::class, 'create'])->name('seller.create');
            Route::post('/storeSeller', [App\Http\Controllers\Seller\SellerController::class, 'store'])->name("storeSeller");
            Route::get('/register', [App\Http\Controllers\Seller\RegisterController::class, 'create'])->name('sellers.register');

            Route::group(['middleware' => ['seller'], 'as' => 'seller.'], function () {
                //dashboard
                Route::get('/dashboard', [App\Http\Controllers\Seller\SellerController::class, 'index'])->name('home');

                //Branch
                Route::resource('branch', App\Http\Controllers\Seller\BranchController::class);

                Route::get("/branchs", [App\Http\Controllers\Seller\BranchController::class, 'index'])->name("branchs");
                Route::get("/branchNew", [App\Http\Controllers\Seller\BranchController::class, 'create'])->name("new.branch");
                Route::get("/branchsShow/{id}", [App\Http\Controllers\Seller\BranchController::class, 'show'])->name("branch.show");
                Route::post("/branchsStore", [App\Http\Controllers\Seller\BranchController::class, 'store'])->name("branch.store");
                Route::PATCH("/branchsEdit/{id}", [App\Http\Controllers\Seller\BranchController::class, 'update'])->name("branch.update");

                //Seller
                Route::get('user/profile', [App\Http\Controllers\Seller\SellerController::class, 'show_profile'])->name('user.profile');
                Route::get('user/profile/edit', [App\Http\Controllers\Seller\SellerController::class, 'edit_profile'])->name('user.edit_profile');
                Route::put('user/profile/update', [App\Http\Controllers\Seller\SellerController::class, 'update_profile'])->name('user.update_profile');
                Route::resource('user', 'SellerController')->except(['show', 'edit']);

                //attributes
                Route::post('/attributes-product', [App\Http\Controllers\Seller\ProductsController::class, 'getProductAttributesAjax'])->name('product.attributes');

                //products
                Route::get('/products/export', [App\Http\Controllers\Seller\ProductsController::class, 'export'])->name('products.export');
                Route::get('/products/import', [App\Http\Controllers\Seller\ProductsController::class, 'importShow'])->name('products.import.show');

                /* Route::get('/products/import',[App\Http\Controllers\Seller\ProductsController::class, 'import'])->name('products.importExcel'); */

                Route::post('/products/importExcel', [App\Http\Controllers\Seller\ProductsController::class, 'import'])->name('products.importSheet');
                Route::get('/products', [App\Http\Controllers\Seller\ProductsController::class, 'index'])->name('products.index');
                Route::get('/products/downLoadSheetTemp', [App\Http\Controllers\Seller\ProductsController::class, 'sheetTemp'])->name('sheetTemp');
                Route::get('/products/onsale', [App\Http\Controllers\Seller\ProductsController::class, 'onSale'])->name('products.onsale');
                Route::get('/products/hot', [App\Http\Controllers\Seller\ProductsController::class, 'onHot'])->name('products.hot');

                Route::get('product/attribute/{product}', [App\Http\Controllers\Seller\ProductsController::class, 'attribute_index'])->name('products.attribute.index');
                Route::post('product/attribute/{product}/store', [App\Http\Controllers\Seller\ProductsController::class, 'attribute_store'])->name('products.attribute.store');
                Route::delete('product/attribute/{product}/delete/{attribute}', [App\Http\Controllers\Seller\ProductsController::class, 'attribute_delete'])->name('products.attribute.destroy');
                Route::put('product/attribute/{product}/update/{attribute}', [App\Http\Controllers\Seller\ProductsController::class, 'attribute_update'])->name('products.attribute.update');

                Route::get('/products/create', [App\Http\Controllers\Seller\ProductsController::class, 'create'])->name('products.create');
                Route::post('/products', [App\Http\Controllers\Seller\ProductsController::class, 'store'])->name('products.store');
                Route::get('/products/show/{product}', [App\Http\Controllers\Seller\ProductsController::class, 'show'])->name('products.show');
                Route::get('/products/edit/{product}', [App\Http\Controllers\Seller\ProductsController::class, 'edit'])->name('products.edit');
                Route::patch('/products/{product}', [App\Http\Controllers\Seller\ProductsController::class, 'update'])->name('products.update');
                Route::delete('/products/{product}', [App\Http\Controllers\Seller\ProductsController::class, 'destroy'])->name('products.destroy');

                //Orders
                Route::resource('orders', App\Http\Controllers\Seller\OrderController::class);
                Route::Post('/getOrder', [App\Http\Controllers\Seller\OrderController::class, 'getOrder']);
                Route::post('/orderstatus/{id}', [App\Http\Controllers\Seller\OrderController::class, 'changeOrderStatus']);

                //Non CRUD Operations
                Route::post('/products/data/{kind?}', [App\Http\Controllers\Seller\ProductsController::class, 'data'])->name('products.data');
                Route::get('/product/activation/{id}', [App\Http\Controllers\Seller\ProductsController::class, 'activation'])->name('products.active');

            });

        });

    });


Route::get('/list_sellers', [\App\Http\Controllers\Admin\AdminUsersController::class, 'list_seller'])->name('seller.list');
Route::get('/seller/change_state/{seller_id}', [\App\Http\Controllers\Admin\AdminUsersController::class, 'change_seller_state'])->name('admin.seller.change_state');


/** myRoutes **/
Route::get('/try_mail', 'SellerController@index');
Route::get('/try_FaceBook', 'Auth\SocialLoginController@getBack');

//Route::get('/user/login','HomeController@login')->name("login");

/*===================================================End Seller===========================================================================*/

Route::get('/user/login', [App\Http\Controllers\Website\Auth\LoginController::class, 'login'])->name('login');
