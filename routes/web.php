<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CMSPages;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('login/facebook', [App\Http\Controllers\Auth\SocialLoginController::class, 'facebookRedirectToProvider'])->name('login.facebook');
Route::get('login/facebook/callback', [
    App\Http\Controllers\Auth\SocialLoginController::class, 'facebookHandleProviderCallback'
])->name('login.facebook.callback');

Route::get('{slug?}', [
    HomeController::class, 'index'
])->where('slug', 'index|home')->name('index');

Route::get('categories-tab-{category}/view', [HomeController::class, 'categoryTab'])->name('categories.tab-view');
Route::get('products-{product}/quick-view', [HomeController::class, 'quickView'])->name('products.quick-view');

Route::get('products', [ProductsController::class, 'index'])->name('products.index');
Route::post('products/api', [ProductsController::class, 'api'])->name('products.api');
Route::get('products/{product_slug}', [ProductsController::class, 'show'])->name('products.show');

///#### USER ROUTES ####/

//Route::get('user/profile',[UserProfileController::class,'showProfile'])->name('userProfile');

Route::group(['prefix' => '/user', 'middleware' => 'auth:web'], function () {
    Route::get('/profile-show', [UserProfileController::class, 'showProfile'])->name('user-profile-show');

    Route::get('/change-password', [UserProfileController::class, 'showPasswordForm'])->name('view-change-password');
    Route::post('/update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');

    Route::get('/view-update-user-profile', [UserProfileController::class, 'viewUserProfile'])->name('view-update-profile');
    Route::post('/update-user-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');

    Route::group(['prefix'=>'user-orders'], function () {
        Route::get('view-related-orders-prices', [OrderController::class,'index'])->name('show.related.orders');
        Route::get('order={order}/viewOrderPrices', [OrderController::class,'viewOrderPrices'])->name('viewOrderPrices');

        Route::get('order={order}/order-details', [OrderController::class,'show'])->name('view.related.orders.details');
    });

    Route::get('page/show/{id}', [PagesController::class,'show'])->name('page-view');

    // UPDATE USER ORDER ADDRESSES
    Route::group(['prefix' => 'order-addresses'], function () {
        Route::get('/view-user-addresses', [UserProfileController::class, 'viewUserAddress'])->name('view-addresses');
        Route::post('/new-user-address', [UserProfileController::class, 'newUserAddress'])->name('new-user-address');
        Route::post('/update-user-addresses/address={address_id}', [UserProfileController::class, 'updateUserAddress'])->name('update-user-address');
    });
});

####### CART GROUP
Route::group(['prefix'=>'cart'], function () {
    Route::post('/item/{product}', [CartController::class, 'addItem'])->name('cart.item');
    Route::delete('/item/attribute_translations{product}', [CartController::class, 'deleteItem'])->name('cart.item.delete');
    Route::get('/removeItem/{item_id}', [CartController::class, 'cartRemoveItem'])->name('cart.product.remove');
    Route::get('/', [CartController::class, 'view'])->name('cart.view');

    Route::get('/item-quantity/{item_id}/quantity={quantity?}', [CartController::class, 'updateItemQuantity'])->name('cart.quantity');

    Route::get('/get-total-prices', [CartController::class, 'getTotalPrices'])->name('getCartPrices');
});

####### ORDER GROUP
Route::group(['prefix'=>'order'], function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('cart.checkout');
    Route::post('/add-new-order', [OrderController::class, 'store'])->name('cart.order.checkout');
    Route::post('/view-order-sipping-details', [OrderController::class, 'viewOrderWithShipping'])->name('shipping.order.checkout');
    Route::get('/order-success', [OrderController::class, 'successOrder'])->name('order.success');
    Route::get('/order-error', [OrderController::class, 'errorOrder'])->name('order.error');
});

Route::get('get-sate-cities-onChange/state_id={state_id?}', [HomeController::class, 'getStateCities'])->name('get-sate-cities-onChange');

Route::post('/user/checkout-user-login', [LoginController::class, 'checkoutUserLogin'])->name('checkout.user.login');

Route::get('send-subscribe', [UserProfileController::class,'userSubscribe'])->name('sendSubscribe');

Route::get('/contact-us', [CMSPages::class,'contact_us'])->name('contactUs');

Route::post('/send-contact-us', [CMSPages::class,'sendContactMessage'])->name('sendContactMessage');

Route::get('/about-us', [CMSPages::class,'about_us'])->name('aboutUs');

Route::get('page-view/{slug}', [App\Http\Controllers\Admin\PagesController::class,'show'])->name('openPageContent');


Route::post('/mainSearch-input', [HomeController::class,'search'])->name('header-search');

//Route::get('/showP', [ProductsController::class, 'showP']);
