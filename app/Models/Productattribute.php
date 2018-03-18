<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productattribute extends Model
{
    protected $fillable = ['product_id', 'attribute_id', 'attribute_value', 'attribute_price'] ;

    public function attribute()
    {
    	return $this->belongsTo(Attribute::class) ;
    }
    
}
