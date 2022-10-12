<?php

namespace App\Models;

use Etchfoda\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['document'];

    protected $fillable = ['is_active'];

}
