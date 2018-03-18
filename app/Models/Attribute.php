<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $fillable = ['name', 'input_type', 'attribute_type', 'attribute_value', 'attribute_index', 'sort_order', 'group'];

    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }

    public function setAttributeValueAttribute($value)
    {
    	$this->attributes['attribute_value'] = $value ? $value : '' ;
    }

    //字段类型  数值也可以写在配置文件中
    public function input_type()
    {
    	$inputType = [1=>'文本字段', '下拉列表', '多行文本'];
    	return $inputType[$this->input_type];
    }

    public function attribute_type()
    {
    	$attributeType = ['单独属性', '可选属性'];
    	return $attributeType[$this->attribute_type];
    }

    public function attribute_index()
    {
    	$attributeIndex = ['不可以检索', '关键字检索', '范围检索'] ;
    	return $attributeIndex[$this->attribute_index];
    }

    public function productattributes()
    {
        return $this->hasMany(Productattribute::class) ;
    }
}
