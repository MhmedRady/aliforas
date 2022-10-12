<?php

use Illuminate\Support\Facades\Route;

/**** AUTH USER CONFIGURATIONS */
Route::post('register', [App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('forget', [App\Http\Controllers\Api\Auth\AuthController::class, 'forgetPassword']);
Route::post('reset', [App\Http\Controllers\Api\Auth\AuthController::class, 'resetPassword']);
Route::post('home', \App\Http\Controllers\Api\HomeController::class);
Route::get('site/preferences', [\App\Http\Controllers\Api\HomeController::class, 'preferences']);
Route::get('mainSetting', [\App\Http\Controllers\Api\HomeController::class, 'mainSetting']);
Route::post('contact-us', [\App\Http\Controllers\Api\HomeController::class, 'sendContactMessage']);

/** Brand Routes */
Route::prefix('brands')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\BrandsController::class, 'index']);
    Route::get('/{id}/products', [\App\Http\Controllers\Api\BrandsController::class, 'products']);
});

/** Categories Routes */
Route::prefix('categories')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\CategoriesController::class, 'index']);
    Route::get('/parent/{paginate?}', [App\Http\Controllers\Api\CategoriesController::class, 'parent_categories']);
    Route::get('/sub/{paginate?}', [App\Http\Controllers\Api\CategoriesController::class, 'Child_categories']);
    Route::get('/children', [App\Http\Controllers\Api\CategoriesController::class, 'category_children']);
    Route::get('/{category}/products', [App\Http\Controllers\Api\CategoryProductsController::class, 'index']);

    Route::get('/{id}/products', [\App\Http\Controllers\Api\CategoryProductsController::class, 'products']);
});

/** Categories Routes */
Route::prefix('companies')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\CompanyController::class, 'index']);
    Route::get('/{id}/products', [\App\Http\Controllers\Api\CompanyController::class, 'products']);
});


/** Products Routes */
Route::prefix('products')->group(function () {
    Route::get('/show/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'show'])->name('showProduct');
    Route::post('/filter', [\App\Http\Controllers\Api\ProductsController::class, 'filter']);
    Route::post('/onSale', [\App\Http\Controllers\Api\ProductsController::class, 'filter']);
    Route::post('/hot', [\App\Http\Controllers\Api\ProductsController::class, 'filter']);
    Route::get('/orders', [\App\Http\Controllers\Api\ProductsController::class, 'orders']);
    Route::get('/latest', [\App\Http\Controllers\Api\ProductsController::class, 'latestTen']);
    Route::get('/related/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'related']);
});

/** Slider Routes */
Route::get('/slider', [\App\Http\Controllers\Api\SliderController::class, 'slider']);

Route::group(['prefix'=>'branches'], function (){
    Route::get('/viewProductBranch/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'viewProductBranch']);
    Route::get('/withProducts/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'branchWithProducts']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('home/auth', \App\Http\Controllers\Api\HomeController::class);

    /**** AUTH USER UPDATES */
    Route::get('authUser', [App\Http\Controllers\Api\Auth\AuthController::class, 'authUser']);
    Route::get('user/{id}', [App\Http\Controllers\Api\Auth\AuthController::class, 'user_details']);
    Route::post('/auth_user_Update', [App\Http\Controllers\Api\Auth\AuthController::class, 'updateProfile']);
    Route::post('/update_password', [App\Http\Controllers\Api\Auth\AuthController::class, 'updatePassword']);
    Route::get('/shipping_addresses', [App\Http\Controllers\Api\Auth\AuthController::class, 'getUserAddresses']);

    /**** AUTH USER LOGOUT REMOVE ALL TOKENS */
    Route::post('/logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);

    /** Products Routes */
    Route::prefix('auth/products')->group(function () {
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ProductsController::class, 'show']);
        Route::post('/filter', [\App\Http\Controllers\Api\ProductsController::class, 'filter']);
        Route::post('/onSale', [\App\Http\Controllers\Api\ProductsController::class, 'filter']);
        Route::post('/hot', [\App\Http\Controllers\Api\ProductsController::class, 'filter']);
        Route::get('/orders', [\App\Http\Controllers\Api\ProductsController::class, 'orders']);
        Route::get('/latest', [\App\Http\Controllers\Api\ProductsController::class, 'latestTen']);
    });

    Route::post('products/view-product', [\App\Http\Controllers\Api\ProductsController::class, 'viewProduct']);
    Route::post('products/viewed-products', [\App\Http\Controllers\Api\ProductsController::class, 'viewedProducts']);

    /** Wishlist */
    Route::group(['prefix'=>'wishlists'], function () {
        Route::post('/me', [\App\Http\Controllers\Api\WishlistController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\WishlistController::class, 'store']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\WishlistController::class, 'destroy']);
    });

    /** Cart */
    Route::group(['prefix'=>'cart'], function () {
        Route::get('/', [\App\Http\Controllers\Api\CartController::class, 'view']);
        Route::post('/item/{product}', [\App\Http\Controllers\Api\CartController::class, 'addItem']);
        Route::get('/get-total-prices', [\App\Http\Controllers\Api\CartController::class, 'getTotalPrices']);
        Route::get('/remove-item/{item_id}', [\App\Http\Controllers\Api\CartController::class, 'deleteItem']);
        Route::get('/clear', [\App\Http\Controllers\Api\CartController::class, 'clearCart']);
        Route::post('/item-quantity/{item_id}', [\App\Http\Controllers\Api\CartController::class, 'updateItemQuantity']);
    });

    Route::group(['prefix'=>'order'], function () {
        Route::post('/store', [\App\Http\Controllers\Api\OrderController::class, 'store']);
        Route::post('/list', [\App\Http\Controllers\Api\OrderController::class, 'userOrders']);
        Route::post('/{id}/details', [\App\Http\Controllers\Api\OrderController::class, 'viewOrder']);
        Route::post('/{id}/cancel', [\App\Http\Controllers\Api\OrderController::class, 'cancelOrder']);
    });

    Route::get('my-addresses', [\App\Http\Controllers\Api\OrderController::class, 'userAddresses']);
    Route::get('states', [\App\Http\Controllers\Api\LocationsController::class, 'states']);
    Route::get('states/{state}/cities', [\App\Http\Controllers\Api\LocationsController::class, 'stateCities']);
    Route::post('nearst-sellers', [\App\Http\Controllers\Api\LocationsController::class, 'nearestSellers']);

    Route::group(['prefix' => 'messages'], function (){
        Route::get('/', [\App\Http\Controllers\Api\ComplaintController::class, 'index']);
        Route::get('show', [\App\Http\Controllers\Api\ComplaintController::class, 'show']);
        Route::post('store', [\App\Http\Controllers\Api\ComplaintController::class, 'store']);
        Route::delete('delete/{id}', [\App\Http\Controllers\Api\ComplaintController::class, 'destroy']);
    });

});
