<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footprint extends Model
{
    protected $fillable = ['user_id', 'product_id'] ;

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

