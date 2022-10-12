<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Lang;
use App\Models\User;

class MustVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('email', $request->only('email'))->first();
        $user = ($user ?? auth('api')->user());

        if ($user === null) {
            return response()->json([
                'message' => [],
                'errors' => ['error' => Lang::get('auth.emailNotFound')]
            ], 401);
        }

        return ($user->verification_code && $user->email_verified_at && $user->is_active) ?
            $next($request) : response()->json([
                'message' => [],
                'errors' => ['error' => Lang::get('auth.mustVerify')],
            ], 401);
    }
}
