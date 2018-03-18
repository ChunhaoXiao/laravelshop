<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['orderinfo_id', 'product_id', 'number', 'product_attribute', 'price'] ;

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function orderinfo()
    {
    	return $this->belongsTo(OrderInfo::class);
    }
}
