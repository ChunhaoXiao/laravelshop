<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\OrderInfo');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','favorite_user');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function orderproducts()
    {
        return $this->hasManyThrough('App\Models\OrderProduct', 'App\Models\OrderInfo','user_id','orderinfo_id');
    }

    public function footprints()
    {
        return $this->hasMany('App\Models\Footprint');
    }
}
