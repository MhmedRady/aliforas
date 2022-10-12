<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Str::startsWith($request->route()->getName(), 'admin.')){
                return route('admin.login');
            }elseif (Str::startsWith($request->route()->getName(), 'seller.')){
                return route('seller.Login');
            }
            return route('login');
        }
    }
}
