<?php
//商品搜索服务
namespace App\Service ;
use App\Models\Product ;
class ProductSearchService
{
	private $query ;
	public function filter(Array $request)
	{
		$this->query = Product::query() ;
    	foreach($request as $k => $v)
    	{
            if($v){
        		if(method_exists($this, $k))
        		{
        			$this->$k($v);
        		}
        		elseif(in_array($k, ['start_price', 'end_price']))
        		{
        			$this->price([$k => $v]);
        	 	}	
            }
    	}	
    	return $this->query ;
	}

	private function keywords($value)
    {
    	$this->query->where('name', 'like', '%'.$value.'%')->orWhere('brief', 'like', '%'.$value.'%');
    }

    private function category($value)
    {
    	$this->query->where('category_id', $value);
    }

    private function product_sn($value)
    {
        $this->query->where('product_sn', 'like', $value.'%');
    }

    private function price($value)
    {
    	if(isset($value['start_price']))
    	{
    		$this->query->where('price', '>', $value['start_price']);
    	}	
    	if(isset($value['end_price']))
    	{
    		$this->query->where('price', '<', $value['end_price']);
    	}	
    }
}