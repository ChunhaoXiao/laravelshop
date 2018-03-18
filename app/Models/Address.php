<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name','user_id','phone', 'province','city','detail_address', 'is_default', 'district']; 
   // protected $table = 'addresses' ;

    public function user()
    {
    	return $this->belongsTo('App\user');
    }

    public function orderinfos()
    {
        return $this->hasMany('App\Models\OrderInfo');
    }

    public function setDefaultAddress()
    {
    	$this->user->addresses()->where('is_default', 1)->update(['is_default' => 0]);
    	$this->update(['is_default'=>1]);
    	return $this ;
    }
   
}
