<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class Category extends Model
{
	use NodeTrait;
    protected $fillable = ['name', 'parent_id', 'sort_order', 'unit', 'is_hot', 'grade'] ;

    public function setUnitAttribute($value)
    {
    	$this->attributes['unit'] = $value ? $value : '' ;
    }

    public function attributes()
    {
    	return $this->hasMany('App\Models\Attribute');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'prarent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category','parent_id');
    }

}

