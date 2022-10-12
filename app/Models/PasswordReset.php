<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PasswordReset extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    protected $fillable = ['email','token','user_id','created_at'];
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

}
