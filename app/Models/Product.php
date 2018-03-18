<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth ;

class Product extends Model
{
    protected $fillable = ['name', 'product_sn', 'category_id', 'price', 'market_price', 'brief', 
    'thumb', 'sales', 'is_hot', 'is_on_sale', 'number', 'unit'];

    /*protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('name', function(Builder $builder){
            $builder->withCount('users');
        });
    }*/

    public function productinfo()
    {
    	return $this->hasOne('App\Models\Productinfo');
    }

    public function productattributes()
    {
    	return $this->hasMany('App\Models\Productattribute');
    }

    public function productgalleries()
    {
        return $this->hasMany('App\Models\ProductGallery');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category')->withDefault(['name' => '未分类']);
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'favorite_user');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function footprints()
    {
        return $this->hasMany(Footprint::class);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name','like','%'.$keyword.'%')->orWhere('brief','like', '%'.$keyword.'%');
    }

    public function getThumbAttribute($value)
    {
        return str_replace('_thumb', '', $value) ;
    }

    public function getOption()
    {
        $productAttributes = $this->productattributes()->whereHas('attribute',function($query){
            $query->where('attribute_index', 1);
        })->groupBy('attribute_value')->get();
        $attributeOption = [] ;
        if($productAttributes->count())
        {
            foreach($productAttributes as $attribute)
            {
                $attributeOption[$attribute->attribute_id][] = $attribute ;
            }
        }
        return $attributeOption ;
        

    }

    public function favorable()
    {
        return $this->users()->where('user_id', Auth::id())->count() == 0 ;
    }

    public function attributeList()
    {
        $attributes = $this->productattributes()->with('attribute')->get() ;
        if($attributes->count()){
            foreach($attributes as $attribute)
            {

                if(isset($attributeList[$attribute->attribute_id]))
                {
                    $attributeList[$attribute->attribute_id]->attribute_value .= '/'.$attribute->attribute_value;
                }
                else
                {
                    $attributeList[$attribute->attribute_id] = $attribute ;
                }
            }

            return $attributeList ;
       }
       return [] ;
    }

}
