<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;

    public array $translatedAttributes = ['name', 'body', 'slug'];
    protected $fillable = ['is_active', 'show_footer', 'show_header'];
}
