<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id', 'user_id', 'number', 'product_attribute', 'price', 'attribute_mark'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function product()
    {
    	return $this->belongsTo(Product::class)->withDefault(['name'=>'商品已删除']);
    }
}
