<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Translations\DealSectionTranslation;
class DealSection extends Model
{
    use Translatable;
    public array $translatedAttributes = ['name','slug'];
    protected $hidden = ['created_at','updated_at'];
}
