<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Localization;

class Translator extends Model
{

    private $webLocal;

    protected $table = "translator_translations";
    protected $fillable = ["locale", "namespace", "group", "item", "text", "locked"];

    public function __construct()
    {
        $this->webLocal = Localization::getLocale();
    }

    public function scopeSelector($q)
    {
        return $q->where("locale", $this->webLocal)->select("item", "text");
    }
}
