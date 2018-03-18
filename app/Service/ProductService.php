<?php
namespace App\Service ;
use App\Models\Product ;
use Illuminate\Http\Request ;
use Image ;
use App\Models\Category;
use Storage ;

class ProductService{

    // 添加/编辑 商品
    public function save($request, $product='')
    {
        $thumb = $this->saveThumb($request) ;
        $thumb = $thumb ? ['thumb' => $thumb] : [] ;
        $data = array_merge($request->all(),$thumb);
        if($product instanceof Product)
        {
            $product->update($data);
            $this->deleteProductAttribute($request->input('attribute', []), $product);
            $this->deleteProductGallery($request->input('galleries', []), $product);
        }
        else 
        {
            $product = Product::create($data);
        }
        $this->updateProductInfo($request->description, $product);
        $this->updateProductAttribute($request->attribute, $product);
        $this->updateProductGallery($request->galleries, $product);
        return $product ;
    }

    //删除商品
    public function delete(Product $product)
    {
        $this->removeThumbFile($product);
        $this->removeGalleryFile($product);
        $product->productattributes()->delete();
        $product->productinfo()->delete();
        $product->productgalleries()->delete();
        $product->delete();
    }

    public function getLatest()
    {
        if(Category::has('products','>', 2)->count()>2)
        {
           $category =  Category::has('products','>=', 3)->limit(4)->get() ;
          
		   return $category ;
        }    
        return Product::where('is_hot',0)->orderBy('created_at')->limit(9)->get() ;
    }

    public function getHotProduct()
    {
        return Product::where('is_hot', 1)->take(3)->get();
    }

    //获取相关产品
    public function getRecommends($product)
    {
        return $product->category->products()->where('id','<>', $product->id)->withCount('users')->orderBy('users_count', 'desc')->limit(5)->get();
    }

    //更新商品属性
    private function updateProductAttribute($attributes, Product $product)
    {
        if($attributes)
        {
            foreach($attributes as $key => $attribute)
            {   
                if(is_array($attribute['attribute_value']))
                {
                    foreach($attribute['attribute_value'] as $k => $v)
                    {
                        if($v)
                        {
                            $row['attribute_price'] =  $attribute['attribute_price'][$k]  ;
                            $row['attribute_number'] = $attribute['attribute_number'][$k] ? : 0;
                            $product->productattributes()->updateOrCreate(['attribute_id' => $key,'attribute_value'=>$v],$row);
                        }
                    }
                }
                else
                {
                    if(isset($attribute['attribute_value']) && $attribute['attribute_value'])
                    {
                        $product->productattributes()->updateOrCreate(['attribute_id' => $key], $attribute);
                    } 
                }      
            }
        }
    }

    //更新商品详情
    private function updateProductInfo($description, Product $product)
    {
        $product->productinfo()->updateOrCreate(['product_id' => $product->id],['description' => $description]);
    }
 
    //更新相册
    private function updateProductGallery($galleries, Product $product)
    {
        if($galleries)
        {
            foreach($galleries as $gallery)
            {
                $name = pathinfo($gallery, PATHINFO_FILENAME);
                $data['img_description'] = request()->input($name, '') ;
                $product->productgalleries()->updateOrCreate(['img_name' => $gallery], $data);   
            }    
        }    
    }

    private function deleteProductGallery($postGalleries, Product $product)
    {
         if($product->productgalleries()->count())
        {

            foreach($product->productgalleries as $gallery)
            {
                if(!in_array($gallery->img_name, $postGalleries))
                {
                    $pic = 'gallery/origin/'.$gallery->img_name ;
                    $this->removeFile($pic);
                    $gallery->delete();
                }    
            }    
        }    
    }

    private function deleteProductAttribute($postAttribute, Product $product)
    {
        if($product->productattributes()->count() > 0)
        {
           // $postAttribute = $this->request->attribute ? array_keys($this->request->attribute) : [];
            foreach($product->productattributes as $attribute)
            {
                if(!in_array($attribute->id, $postAttribute))
                {
                    $attribute->delete();
                }    
                 
            }  
        }    
    }

    private function removeThumbFile(Product $product)
    {
       
        $this->removeFile($product->thumb);
        $this->removeFile($product->getOriginal('thumb'));
        
    }

    private function removeGalleryFile($product)
    {
        if($product->productgalleries()->count())
        {
            foreach($product->productgalleries as $gallery)
            {
                $this->removeFile('gallery/origin/'.$gallery->img_name);
            }
        }
    }

    private function removeFile($file)
    {
        if(storage::exists($file))
        {
            Storage::delete($file);
        }
    }

     private function saveThumb($request)
    {
        if($request->thumb){
            $thumb = $request->thumb->store($request->category_id.'/thumb');
            $image = Image::make($request->thumb);
            $image->resize(200,200);
            $info = pathinfo($thumb);
            $thumb = $info['dirname'].'/'.$info['filename'].'_thumb.'.$info['extension'];
            $image->save('./storage/'.$thumb);
            return $thumb ;
        }
        return false ;
    }


}