<?php

namespace App\Models;

use App\Models\Translations\ReturnReasonTranslation;
use Illuminate\Database\Eloquent\Model;
use Etchfoda\Translatable\Translatable;

class ReturnReason extends Model
{
    use Translatable;

	public array $translatedAttributes = ['name'];
    // protected $fillable = ['code'];
    public function reasons (){
        return $this->hasMany(ReturnReasonTranslation::class);
    }
}
