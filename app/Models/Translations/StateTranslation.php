<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
