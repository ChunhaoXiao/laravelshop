<?php
namespace App\Service ;
use Illuminate\Http\Request ;
use Auth ;
use App\Models\Cart ;
class CartService 
{
	public function addToCart($request, $product)
	{
		$productattr = '' ;
    	$attr_id = [] ;
		if($attribute = $request->attribute)
    	{
    		$attributes = $product->productattributes()->whereIn('id', $attribute)->with('attribute')->get();
    		
    		foreach($attributes as $attribute)
    	    {
	    		if($attribute->attribute_price)
	    		{
	    			$product->price += $attribute->attribute_price ;
	    		}	
	    		$productattr.= $productattr ? ';'.$attribute->attribute->name.':'.$attribute->attribute_value :  $attribute->attribute->name.':'.$attribute->attribute_value;
	    		$attr_id[] = $attribute->id;
    	    }
    	}

    	$data['number'] = $request->numbers;
    	$data['product_attribute'] = $productattr ;
    	$data['price'] = $product->price ;
    	$data['product_id'] = $product->id ;
    	$data['key'] = $attr_id ? 'cart'.$product->id.'-'.implode('-', $attr_id) : 'cart'.$product->id;
    	$data['product']['name'] = $product->name ;

    	if(!Auth::check())
        {
        	return $this->cartToCookie($data);
        }		
        return $this->cartToData($data);
	}

	public function getcart()
	{
		if(!Auth::check())
    	{
    		return collect($this->getCookieCarts()) ;
    	}	
    	return Auth::user()->carts()->with('product')->get();
	}

	public function getCookieCarts()
	{
		$carts = request()->cookie('carts');
    	$carts = $carts ? array_map('unserialize',$carts) : [] ;
    	return $carts;
	}

    //购物车保存到 cookie

	private function cartToCookie($data)
	{
		$key = $data['key'];
		$cart = request()->cookie("carts");
		if(!isset($cart[$key]))
		{
			return response('success')->cookie("carts[$key]", serialize($data), 10);
		}	
		$cookiecart = unserialize($cart[$key]) ;
		$cookiecart['number'] += $data['number'];
		return response('success')->cookie('carts['.$key.']', serialize($cookiecart), 10);
	}

	//购物车保存到数据库
	
	public function cartToData($data)
	{
		$user = Auth::user();
		$cart = $user->carts()->where([['product_id', $data['product_id']],['product_attribute',$data['product_attribute']]])->first();
		if($cart)
		{
			$cart->number += $data['number'] ;
			return $cart->save();
		}
		return $user->carts()->create($data);
	}

	public function cartnum()
	{
		if(!Auth::check())
		{
			return request()->cookie('carts') ? count(request()->cookie('carts')): 0 ;
		}	

		return Auth::user()->carts()->count();
	}
}