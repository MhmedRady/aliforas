<?php

namespace App\Providers;

use App\Http\Middleware\AdminMenuMiddleware;
use App\Http\Middleware\SellerMenuMiddleware;
use App\Http\Middleware\ProductsFilter;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */

    public const HOME = '/';
    public const SELLER = '/seller';
    public const ADMIN = '/big-boss';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        Route::bind('product_slug', function ($value) {
            return Product::query()->whereHas('translations', fn($query) => $query->where('slug', $value))->firstOrFail();
        });

        $this->routes(function () {
            Route::namespace($this->namespace)->group(base_path('routes/storage.php'));

            Route::middleware([
                'web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',
                ProductsFilter::class,
            ])->prefix(LaravelLocalization::setLocale())
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware(['web',
                SellerMenuMiddleware::class,
                'localeSessionRedirect',
                'localizationRedirect',
                'localeViewPath'])
                ->prefix(LaravelLocalization::setLocale())
                ->namespace($this->namespace)
                ->as('seller.')
                ->group(base_path('routes/seller.php'));

            Route::middleware(['web', AdminMenuMiddleware::class])
                ->prefix('big-boss')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));


            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            /*Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->as("web.")
                ->group(base_path('routes/website.php'));*/
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
