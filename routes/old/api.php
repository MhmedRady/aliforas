<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

], function () {
    Route::get('related-products/{product_id}', [App\Http\Controllers\Api\ProductController::class, 'related_product']);
    Route::group(['middleware' => ['cors', 'json.response', 'localization']], function () {
        Route::get('countries', [App\Http\Controllers\Api\CountryController::class, 'index'])->name('country.allData');

        //guest
        Route::group(['middleware' => 'guest:api'], function () {
            Route::post('login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login'])->name('user.login')->middleware('MustVerifyEmail');
            Route::post('facebook-login', [App\Http\Controllers\Api\Auth\RegisterController::class, 'registerFacebook'])->name('user.facebook.login');
            Route::post('register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'register'])->name('user.register');
            Route::post('forgot-pwd', [App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'forgotPwd'])->name('user.forgot-pwd')->middleware('MustVerifyEmail');

            Route::group(['perfix' => 'categories/'], function () {
                Route::get('categories/', [App\Http\Controllers\Api\CategoryController::class, 'index'])->name('category.index');
                Route::get('categories/{category}', [App\Http\Controllers\Api\CategoryController::class, 'show'])->name('category.show');
            });

            Route::group(['perfix' => 'products/'], function () {
                Route::get('products/', [App\Http\Controllers\Api\ProductController::class, 'index'])->name('product.all');
                Route::get('products/latest', [App\Http\Controllers\Api\ProductController::class, 'getLatest'])->name('product.latest');
                Route::get('products/on-sale/', [App\Http\Controllers\Api\ProductController::class, 'onSaleProducts'])->name('product.onSale');
                Route::get('products/on-hot/', [App\Http\Controllers\Api\ProductController::class, 'onHotProducts'])->name('product.onHot');
                Route::get('products/{product}', [App\Http\Controllers\Api\ProductController::class, 'show'])->name('product.show');
                Route::get('products/related-products/{product_id}', [App\Http\Controllers\Api\ProductController::class, 'related_product'])->name('product.related');
            });

            Route::get('sellers/', [App\Http\Controllers\Api\SellerController::class, 'index'])->name('seller.all');
            Route::get('product/branch/{branch}', [App\Http\Controllers\Api\ProductController::class, 'branch_product']);
            Route::get('banner', [App\Http\Controllers\Api\ProductController::class, 'banner']);
        });

        Route::group(['middleware' => ['auth:api', 'MustVerifyEmail']], function () {
            Route::get('logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->name('user.logout');
            Route::apiResource('orders', 'Api\OrderController')->except(['show', 'delete']);
        });

    });
});
