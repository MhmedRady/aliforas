<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

], function () {

    Route::get('/', [App\Http\Controllers\Website\HomeController::class, 'home'])->name('webHome');

    Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('new');

    Route::get('/check_combo_price/{ids}/{combo_id}', [App\Http\Controllers\ComboController::class, 'check_combo_price']);
    Route::get('/category_filter/{id}', [App\Http\Controllers\SearchController::class, 'category_filter']);
    Route::get('/search_filter/{id}', [App\Http\Controllers\SearchController::class, 'search_filter']);
    Route::get('/add_to_compare/{id}', [App\Http\Controllers\HomeController::class, 'compare']);
    Route::get('/remove_from_compare/{id}', [App\Http\Controllers\HomeController::class, 'remove_compare']);

    ///// USER LOGIN & REGISTER

    Route::prefix('/user')->group(function (){

        Route::middleware('guest:web')->group(function (){

            Route::get('/logout', [App\Http\Controllers\Website\Auth\LoginController::class, 'logout'])->name('userLogout');

            Route::get('/login', [App\Http\Controllers\Website\Auth\LoginController::class, 'login'])->name('login');
            Route::post('/_login', [App\Http\Controllers\Website\Auth\LoginController::class, 'userAuth'])->name('userAuth');

            //// FACEBOOK LOGIN
            Route::get('/login/facebook', [App\Http\Controllers\Website\Auth\SocialLoginController::class, 'facebookRedirectToProvider'])->name('login.facebook');


            Route::get('/register', [App\Http\Controllers\Website\Auth\RegisterController::class, 'userRegister'])->name('user-register');
            Route::post('/_register', [App\Http\Controllers\Website\Auth\RegisterController::class, '_userRegister'])->name('addNew-user');
            Route::get('/success_register', [App\Http\Controllers\Website\Auth\RegisterController::class, 'success_register'])->name('success_register');

            Route::get('/reset-Password', [App\Http\Controllers\Website\Auth\UserController::class, 'resetPassword'])->name('resetPassword');
            Route::post('/send_reset-PW_Email', [App\Http\Controllers\Website\Auth\UserController::class, 'sendEmail'])->name('sendResetPW_Mail');

            Route::get('/call_back-reset-Password/{email}/code={token}', [App\Http\Controllers\Website\Auth\UserController::class, 'callBack_resetPassword'])->name('callBack-resetPassword');
            Route::post('/new-Password/{id}/code={token}', [App\Http\Controllers\Website\Auth\UserController::class, 'editPassword'])->name('setNewPassword');

        });

        Route::group(['middleware'=>'auth:web'],function (){

            //// USER Profile
            Route::get('/view-profile',[App\Http\Controllers\Website\Auth\UserController::class,'profile'])->name('user-profile');
            Route::post('/edit-user-profile/{id}',[App\Http\Controllers\Website\Auth\UserController::class, 'updateProfile'])->name('user-update-profile');

            //// CHANGE PASSWORD
            Route::get('/change-user-password',[App\Http\Controllers\Website\Auth\UserController::class,'viewChangePassword'])->name('view-change-password');
            Route::post('/put-change-user-password/{id}',[App\Http\Controllers\Website\Auth\UserController::class,'putChangePassword'])->name('put-change-password');

            ///// ORDERS
            Route::get('/order-list-view',[App\Http\Controllers\Website\OrderController::class,'viewOrderPage'])->name('view-order-list');
            Route::post('/post-order-list-view',[App\Http\Controllers\Website\OrderController::class,'postOrderList'])->name('post-order-list');
            Route::post('/post-order-list/user_id={id}/order-code={code}',[App\Http\Controllers\Website\OrderController::class,'addNewOrder'])->name('postNewOrder');
            Route::get('/checkout',[App\Http\Controllers\Website\OrderController::class,'order_checkout'])->name('checkout');
            Route::get('/order-success-billing/Bill={code}',[App\Http\Controllers\Website\OrderController::class,'order_billing'])->name('order-billing');
        });
        Route::get('/web_sittings/change_state/state={state_id?}',[App\Http\Controllers\Website\HomeController::class, 'changeState'])->name('change-state');
        Route::post('/email-subscribe', [App\Http\Controllers\Website\Auth\UserController::class, 'subscribe'])->name('email-subscribe');
    });

    /***** START HOME PAGE ******/

    ///// PRODUCTS
    Route::get('quick/{product}', [App\Http\Controllers\Website\ProductController::class, 'quick_view'])->name('product.quick');
    Route::get('/{product}/view', [App\Http\Controllers\Website\ProductController::class, 'show'])->name('products.show');
    Route::get('/products-filters',[App\Http\Controllers\Website\ProductController::class,'filterProducts'])->name('products.filterProducts');

    //// SHOPPING PAGE
    Route::get('/product/all', [App\Http\Controllers\Website\ProductController::class, 'viewAll'])->name('shoppingPage');
    Route::get('/product/relation={relation}&relate_id={relate_id}/all', [App\Http\Controllers\Website\ProductController::class, 'getRelation'])->name('products.relation.all');


//    Route::get('/product/{brand}/all', [App\Http\Controllers\ReviewController::class, 'setRating'])->name('products.brand');
//    Route::get('/product/relation={relation}/id={slug}/all', [App\Http\Controllers\Website\ProductController::class, 'sellerProducts'])->name('products.seller');
//    Route::get('/product/{category}/all', [App\Http\Controllers\ReviewController::class, 'setRating'])->name('products.category');

    //// Wishlist
    Route::get('/Wishlist/quickList', [App\Http\Controllers\Website\WishlistController::class, 'quickList'])->name('Wishlist.quick');
    Route::get('/Wishlist/{slug}/addNew', [App\Http\Controllers\Website\WishlistController::class, 'addToWishList'])->name('Wishlist.addNew');
    Route::get('/Wishlist/showAll', [App\Http\Controllers\Website\WishlistController::class, 'showWishList'])->name('Wishlist.showAll');
    Route::get('/Wishlist/remove={slug}', [App\Http\Controllers\Website\WishlistController::class, 'removeItem'])->name('Wishlist.removeItem');

    //// CartList
    Route::get('/CartList/quickList', [App\Http\Controllers\Website\CartController::class, 'quickList'])->name('cartList.quick');
    Route::get('/CartList/{slug}/addNew', [App\Http\Controllers\Website\CartController::class, 'addToCartList'])->name('CartList.addNew');
    Route::get('/CartList/showAll', [App\Http\Controllers\Website\CartController::class, 'showCartList'])->name('CartList.showAll');
    Route::get('/CartList/remove={slug}', [App\Http\Controllers\Website\CartController::class, 'removeItem'])->name('CartList.removeItem');

    //// SEARCH PAGE
    Route::get('/search/page-view',[App\Http\Controllers\Website\SearchController::class,'viewSearchPage'])->name('view-search-page');
    Route::post('/search/get-search',[App\Http\Controllers\Website\SearchController::class,'viewSearchContent'])->name('view-search-content');

    /***** END HOME PAGE ****/


//    Route::post('/user-Login', [App\Http\Controllers\Auth\LoginController::class, '_login'])->name('user-Login');

    Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('new.register');
    Route::get('/cancel_order/{id}', [App\Http\Controllers\CheckoutController::class, 'cancel_order']);
    Route::get('/order_update/{product}/{order}/{reason}/{bank_name}/{bank_number}', [App\Http\Controllers\ReturnReasonController::class, 'return_request']);
    Route::get('/get_cities/{country_id}', [App\Http\Controllers\CheckoutController::class, 'get_cities'])->name('new');

    // google
    Route::get('login/google', [App\Http\Controllers\Auth\SocialLoginController::class, 'googleRedirectToProvider'])->name('login.google');
    Route::get('login/google/callback', [App\Http\Controllers\Auth\SocialLoginController::class, 'googleHandleProviderCallback']);

    // twitter
    Route::get('login/twitter', [App\Http\Controllers\Auth\SocialLoginController::class, 'twitterRedirectToProvider'])->name('login.twitter');
    Route::get('login/twitter/callback', [App\Http\Controllers\Auth\SocialLoginController::class, 'twitterHandleProviderCallback']);
    Route::get('get-agree-terms', [App\Http\Controllers\HomeController::class, 'get_agree_terms']);

    Route::get('/old', [App\Http\Controllers\HomeController::class, 'index']);
    /* Route::get('/', [App\Http\Controllers\HomeController::class, 'new'])->name('home'); */

    Route::get('/allcategories', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    Route::get('/{page}/page', [App\Http\Controllers\HomeController::class, 'page'])->name('page');
    Route::get('/account/verify/show/{id?}', [App\Http\Controllers\VerificationController::class, 'verifyForm'])->name('account.verify.show');
    Route::post('/account/verify', [App\Http\Controllers\VerificationController::class, 'verify'])->name('account.verify');
    Route::get('/account/verify/resend', [App\Http\Controllers\VerificationController::class, 'resend'])->name('account.verify.resend');

    // products
    // Route::get('/{product}/p',[App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');
    // Route::post('/{product}/p',[App\Http\Controllers\ProductsController::class, 'write_review']);

    Route::get('/{category}/c', [App\Http\Controllers\SearchController::class, 'category'])->name('categories.products.search');
    Route::post('/{category}/c', [App\Http\Controllers\SearchController::class, 'category_filter'])->name('categories.products.search');

    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('products.search');
    Route::get('/search/seller/{seller}', [App\Http\Controllers\SearchController::class, 'index'])->name('seller.products.search');

    Route::get('/dealsection/{slug}', [App\Http\Controllers\SearchController::class, 'dealsection'])->name('products.search');
    Route::post('/product/rate', [App\Http\Controllers\ReviewController::class, 'setRating'])->name('products.rate');

    // wishlist
    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'show'])->name('wishlist.show');
    Route::get('/wishlist/store', [App\Http\Controllers\WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist/get', [App\Http\Controllers\WishlistController::class, 'getWishlist'])->name('wishlist.get');
    Route::get('/wishlist/delete', [App\Http\Controllers\WishlistController::class, 'delete'])->name('wishlist.delete');

    // Compare
    Route::get('/compare', [App\Http\Controllers\HomeController::class, 'show_compare'])->name('wishlist.show');

    // cart
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'show'])->name('cart.show');
    Route::get('/buynow', [App\Http\Controllers\CartController::class, 'buynow'])->name('cart.buynow');
    Route::get('/cart/store', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/get', [App\Http\Controllers\CartController::class, 'getCart'])->name('cart.get');
    Route::get('/cart/delete', [App\Http\Controllers\CartController::class, 'delete'])->name('cart.delete');
    Route::get('/cart/flush', [App\Http\Controllers\CartController::class, 'deleteAll'])->name('cart.flush');
    Route::get('/p/attribute/check', [App\Http\Controllers\CartController::class, 'checkAttributes'])->name('product.attribute.validate');

    // checkout
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/order/history', [App\Http\Controllers\CheckoutController::class, 'orderHistory'])->name('order.history');
    Route::get('/order/history/{id}', [App\Http\Controllers\CheckoutController::class, 'orderHistoryOrder'])->name('order.history.order');
    Route::post('/order/history/{id}', [App\Http\Controllers\ProductsController::class, 'write_review']);
    Route::get('/order/success', [App\Http\Controllers\CheckoutController::class, 'orderSuccess'])->name('order.success');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout.send');
    Route::get('/response', [App\Http\Controllers\HomeController::class, 'response'])->name('response.show');

    // coupon
    Route::get('/coupon/apply/{code}', [App\Http\Controllers\CouponsController::class, 'applyCoupon'])->name('coupon.apply');

    // users
    Route::get('/user/profile/{id}', [App\Http\Controllers\UsersController::class, 'showProfile'])->name('user.profile');
    Route::post('/user/profile/', [App\Http\Controllers\UsersController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/user/points', [App\Http\Controllers\PointController::class, 'index'])->name('user.points.index');
    Route::get('/convert_points', [App\Http\Controllers\PointController::class, 'convert_points'])->name('user.points.convert_points');
    Route::get('/user/wallet', [App\Http\Controllers\WalletController::class, 'index'])->name('user.wallet.index');

    Route::get('/user/complaints', [App\Http\Controllers\ComplaintController::class, 'index'])->name('user.complaints.index');
    Route::post('/user/complaints', [App\Http\Controllers\ComplaintController::class, 'store'])->name('user.complaints.store');

    Route::get('/gmap/show/', [App\Http\Controllers\HomeController::class, 'showMap'])->name('gmap.show');

    // phone sms
    Route::get('/trysms', [App\Http\Controllers\HomeController::class, 'trysms']);
    Route::get('/tryemail', [App\Http\Controllers\HomeController::class, 'tryemail']);
    Route::get('/trylogger', [App\Http\Controllers\HomeController::class, 'trylogger']);

    Route::get('/subscribe/{email}', [App\Http\Controllers\HomeController::class, 'subscribe']);

});

Route::get('user/login/facebook/callback', [App\Http\Controllers\Website\Auth\SocialLoginController::class, 'facebookHandleProviderCallback']);
