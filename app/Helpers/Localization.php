<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

/**
 * used to get and set locale of the current session.
 * @author Omar Hossam EL-Din Kandil <okandil273@gmail.com>
 * Updated By Mohamed Rady <Mhmed.rady.95@gmail.com>
 */
class Localization
{
    /**
     * will get the current language of the session
     * @return string $locale
     */
    public static function getLocale() : string
    {
        return App::getLocale();
    }

    /**
     * will set the current language of the session
     * @param string $language
     * @return void
     */
    public static function setLocale(string $language)
    {
        App::setLocale($language);
    }

    /**
     * set tag class text direction
     * @return string getData
     */

    public static function setTextAlign(){
        return self::getLocale() == "en" ? "text-left": "text-right";
    }
}
