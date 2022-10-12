<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    //

    protected $appends = ["date_time"];

    protected $fillable = ['from', 'to', 'title', 'body', 'seller_read'];

    public function get_user($id)
    {
        return User::find($id);
    }

    public function getDateTimeAttribute($val): string
    {
        $carbonDate = new \Carbon\Carbon($this->created_at);
        return $carbonDate->diffForHumans();
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'to');
    }

}
