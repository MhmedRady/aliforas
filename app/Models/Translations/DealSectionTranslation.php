<?php

namespace App\Models\Translations;

use App\Models\DealSection;
use Illuminate\Database\Eloquent\Model;

class DealSectionTranslation extends Model
{
    protected $table = "deal_sections_translations";

    public function dealsection()
    {
        return $this->belongsTo(DealSection::class);
    }

    public function product_ids()
    {
        return DealSection::find($this->deal_section_id);
    }
}
