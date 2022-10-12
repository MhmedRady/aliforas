<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slider;

class SliderTranslation extends Model
{
    use HasFactory;

    protected $table = 'slider_translations';

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
