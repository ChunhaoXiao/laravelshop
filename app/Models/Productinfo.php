<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productinfo extends Model
{
    protected $fillable = ['product_id', 'description'];

    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }
}
