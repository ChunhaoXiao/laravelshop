<?php
namespace App\Observers;
use App\Models\Product ;
use Illuminate\Http\Request ;
use Storage ;
class ProductObserver{
	private $request ;
	public function __construct(Request $request)
	{
        $this->request = $request ;
	}

	//添加数据到关联表（这里打破了一个函数只有一个单独功能的原则，但我也没有太好的办法拆分这些功能，每个功能再单独写一个方法？）
	public function created(Product $product)
	{
		//商品详细信息
		$product->productinfo()->create(['description' => $this->request->description]);

		//商品属性
		if($attributes = $this->request->attribute)
		{
		    foreach($attributes as $key => $attribute)
		    {
		    	if(isset($attribute['attribute_value']) && !empty($attribute['attribute_value']))
		    	{
		    		$attribute['attribute_id'] = $key ;
		    		$row[] = $attribute ;
		    	}	
		    }
		    $product->productattributes()->createMany($row);
		} 

		//商品相册
		if($galleries = $this->request->galleries)
	    {
	    	foreach($galleries as $key => $gallery)
	    	{
	    		$name = pathinfo($gallery, PATHINFO_FILENAME);
	    		$data[$key]['img_name'] = $gallery ;
	    		$data[$key]['img_description'] = $this->request->$name;
	    	}	
	    	$product->productgalleries()->createMany($data);
	    } 	
	}

	public function updated(Product $product)
	{
		$product->productinfo()->update(['description' => $this->request->description]);
		//处理属性
		$postAttributes = [] ;
		if($attributes = $this->request->attribute)
		{
		    foreach($attributes as $key => $attribute)
		    {
		    	if(isset($attribute['attribute_value']) && !empty($attribute['attribute_value']))
		    	{
		    		$product->productattributes()->updateOrCreate(['attribute_id' => $key], $attribute);	
		    		$postAttributes[] = $key ;
		    	}	
		    }
		} 
		if($product->productattributes->count()>0)
		{
			foreach($product->productattributes as $attribute)
			{
				if(!in_array($attribute->attribute_id, $postAttributes))
				{
					$attribute->delete();
				}	
			}	
		}

		//处理相册
		$galleries = $this->request->input('galleries', []);
		if(count($galleries) > 0){
	    	foreach($galleries as $key => $gallery)
	    	{
	    		$name = pathinfo($gallery, PATHINFO_FILENAME);
	    		//$data['img_name'] = $gallery ;
	    		$data['img_description'] = $this->request->input($name, '');

	    		if(Storage::exists('gallery/origin/'.$gallery))
	    		{
	    			$product->productgalleries()->updateOrCreate(['img_name' => $gallery], $data);
	    		}	
	    	}
        }

    	foreach($product->productgalleries as $gallery)
    	{
    		if(!in_array($gallery->img_name, $galleries))
    		{
    			Storage::delete('gallery/origin/'.$gallery->img_name);
    			$gallery->delelte() ;
    		}	
    	}	
	     		
	}

	public function deleted(Product $product)
	{
		$product->productinfo()->delete();
		if(Storage::exists($product->thumb))
		{
			Storage::delete($product->thumb);
		}	
		$product->productattributes()->delete();
		if($product->productgalleries()->count()>0)
		{
			foreach($product->productgalleries as $gallery)
			{
				if(Storage::exists('gallery/origin/'.$gallery->img_name))
				{
					Storage::delete('gallery/origin/'.$gallery->img_name);
					Storage::delete('gallery/thumb/'.$gallery->img_name);
				}	
			}
			$product->productgalleries()->delete() ;	
		}	
	}


	/*private function attributeUpadte($attributes, $product)
	{
		if(!$currentAttributes = $product->productattributes()->count())
		{
			$row = [] ;
			foreach($attributes as $key => $attribute)
		    {
	    		$attribute['attribute_id'] = $key ;
	    		$row[] = $attribute ;
		    }
		   return  $product->productattributes()->createMany($row);
		}

		foreach($attributes as $key => $attribute)
	    {
    		$product->productattributes()->updateOrCreate(['attribute_id' => $key], $attribute);	
    		$postAttributes[] = $key ;
	    }

	    foreach($product->productattributes as $attribute)
		{
			if(!in_array($attribute->attribute_id, $postAttributes))
			{
				$attribute->delete();
			}	
		}	
	}*/
}