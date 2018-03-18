<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['product_id', 'user_id', 'content', 'comment_level'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
