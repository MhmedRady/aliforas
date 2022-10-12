<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{

    use HasFactory;
    protected $table = 'branch_product';
    protected $fillable = ['product_id', 'branch_id','quantity'];
    public $timestamps = false;

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

}
