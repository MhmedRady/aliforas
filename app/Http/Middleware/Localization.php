<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Helpers\Localization as locale;

class Localization
{
    /**
     * handeling language by set locale language depending on
     * Content-Language header
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        // read the language from the request header
        $locale = $request->header('Content-Language');
        // if not set return u have to set Content_Language Header
        if (!$locale)
            return response()->json(['message' => Lang::get('auth.setHeaderLang')], 200);
        // set the local language
        locale::setlocale($locale);

        return $next($request);
    }
}
