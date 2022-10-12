<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class BranchTranslation extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function branch()
    {
        return $this->belongsTo(App\Models\Branch::class);
    }
}
