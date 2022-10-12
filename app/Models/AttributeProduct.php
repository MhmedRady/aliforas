<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Translations\AttributeTranslation;
class AttributeProduct extends Model
{
    protected $table = "attribute_product";
    public $translatable = ['name'];
    protected $fillable=['quantity','attribute_id','price','product_id','value'];

    public function get_attribute_name($id){
        $attrs_trans = AttributeTranslation::where('attribute_id',$id)->where('locale','en')->first();
        if($attrs_trans){
            return $attrs_trans->name;
        }else{
            return '';
        }
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }



}
