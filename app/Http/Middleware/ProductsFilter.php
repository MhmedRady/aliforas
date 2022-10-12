<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Scopes\ActiveScope;
use App\Scopes\AvailableScope;
use Closure;
use Illuminate\Http\Request;

class ProductsFilter
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Product::addGlobalScope(new ActiveScope());
        Product::addGlobalScope(new AvailableScope());
        return $next($request);
    }
}
