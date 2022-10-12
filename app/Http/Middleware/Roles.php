<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if (!auth()->guard('admin')->check())
            return redirect()->route('admin.login');
        $admin = auth()->guard('admin')->user();
        if ($admin->role->id == 1){
            return $next($request);
        }

        foreach ($roles as $role){
            if($admin->hasRole($role))
                return $next($request);
        }

    }
}
