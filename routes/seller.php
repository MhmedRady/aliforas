<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix" => '/seller'], function () {

    Route::group(['middleware'=>['guest:seller']], function (){

        Route::get('/login', [App\Http\Controllers\Seller\Auth\LoginController::class, 'loginForm'])->name('Login');
        Route::post('/sellerLogin', [App\Http\Controllers\Seller\Auth\LoginController::class, 'login'])->name("login");

        Route::get('/register', [App\Http\Controllers\Seller\Auth\RegisterController::class, 'registerForm'])->name('register');
        Route::post('/sellerRegister', [App\Http\Controllers\Seller\Auth\RegisterController::class, 'sellerRegister'])->name('storeRegister');

        Route::get('/reset-password',[App\Http\Controllers\Seller\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('forget.password');
        Route::post('/send-reset-link',[App\Http\Controllers\Seller\Auth\ForgotPasswordController::class, 'sendResetEmailLink'])->name('send.rest.link');

        Route::get('/reset-new-password/{token}',[App\Http\Controllers\Seller\Auth\ForgotPasswordController::class, 'showResetForm'])->name('reset.form');
        Route::post('/password-reset',[App\Http\Controllers\Seller\Auth\ForgotPasswordController::class, 'reset'])->name('password.rest');

    });

    Route::group(['middleware' => ['auth:seller']], function () {
        Route::get('/logout', [App\Http\Controllers\Seller\Auth\LoginController::class, 'logout'])->name('logout');

        Route::get('/', [App\Http\Controllers\Seller\SellerController::class, 'index'])->name('home');

        Route::resource('branch', App\Http\Controllers\Seller\BranchController::class)->except(['show']);
        Route::get('branch/activation/{id}', [App\Http\Controllers\Seller\BranchController::class,'activation'])->name('branch.activation');
        Route::get('/branch/makeAsRead', [App\Http\Controllers\Seller\BranchController::class, 'makeAsRead'])->name('branch.makeAsRead');
//        Route::get('user/profile', [App\Http\Controllers\Seller\SellerController::class, 'show_profile'])->name('user.profile');
//        Route::get('user/profile/edit', [App\Http\Controllers\Seller\SellerController::class, 'edit_profile'])->name('user.edit_profile');
//        Route::put('user/profile/update', [App\Http\Controllers\Seller\SellerController::class, 'update_profile'])->name('user.update_profile');

        Route::resource('profile', App\Http\Controllers\Seller\SellerController::class)->except(['create', 'show']);

        Route::resource('orders', App\Http\Controllers\Seller\OrdersController::class);
        Route::get('view-price-orders/{id}', [App\Http\Controllers\Seller\OrdersController::class,'viewOrderPrice'])->name('view-order-price');
        Route::post('update-prices-orders/{id}', [App\Http\Controllers\Seller\OrdersController::class,'updateOrderPrice'])->name('update-order-price');

        Route::get('/products/is_hot', [App\Http\Controllers\Seller\ProductsController::class, 'isHot'])->name('products.is_hot');
        Route::get('/products/on_sale', [App\Http\Controllers\Seller\ProductsController::class, 'onSale'])->name('products.on_sale');

        Route::get('/products/export', [App\Http\Controllers\Seller\ProductsController::class, 'export'])->name('products.export');
        Route::get('/products/importShow', [App\Http\Controllers\Seller\ProductsController::class, 'importShow'])->name('products.importShow');
        Route::post('/products/import', [App\Http\Controllers\Seller\ProductsController::class, 'import'])->name('products.import');

        Route::get('/products/file', [App\Http\Controllers\Seller\ProductsController::class, 'sheetFile'])->name('products.file');

        Route::resource('products', App\Http\Controllers\Seller\ProductsController::class);

        Route::get('/product/activation/{id}', [App\Http\Controllers\Seller\ProductsController::class, 'activation'])->name('products.active');

        Route::get('/orders',[App\Http\Controllers\Seller\OrdersController::class, 'index'])->name('orders.index');

        Route::get('/cancelled_orders', [App\Http\Controllers\Seller\OrdersController::class, 'cancelled_orders'])->name('orders2.cancelled');

        Route::get('/viewOrderPrice',[App\Http\Controllers\Seller\OrdersController::class, 'viewOrderPrice'])->name('orders.viewOrderPrice');

        Route::get('/profile/change-password',[App\Http\Controllers\Seller\SellerController::class,'change_password'])->name('change.password');
        Route::post('/profile/change-password',[App\Http\Controllers\Seller\SellerController::class,'update_password'])->name('update.password');

        Route::get('/attribute-product/check-before-delete{id?}',[App\Http\Controllers\Seller\ProductsController::class,'attributeBeforeDelete'])->name('att-product-before-delete');

        Route::resource('/complaints', \App\Http\Controllers\Seller\ComplaintController::class);
    });
});
