<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AboutUs;

class AboutUsTranslation extends Model
{
    use HasFactory;

    protected $table = 'about_us_translations';
    protected $fillable = ['about_us_id', 'local', 'document'];

    public function translate()
    {
        return $this->belongsTo(AboutUs::class,'about_us_id');
    }

}
