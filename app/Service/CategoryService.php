<?php
namespace App\Service;
use App\Models\Category ;
use Illuminate\Support\Facades\Cache;
use App\Models\Attribute ;
use App\Repositories\CategoryRepositoryInterface ;
/**
* 
*/
class CategoryService
{
    private $category ;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category ;
    }

	public function categoryTree($parent_id = 0)
	{
        $tree = $this->category->categoryTree();
        return $tree;
	}

	/*private function getList($data, $fid = 0,  $deep = 0)
    {
        static $result=array();
        $deep += 1;
        foreach($data as $key => $val)
        {
            if($fid == $val['parent_id'])
            {
                $result[$key] = $val;
                $result[$key]['name']= "|".str_repeat("--", $deep).$val['name'];
                $this->getList($data, $val['id'],  $deep);
            }
        }
        return $result;
    }*/
    
    //获取顶级级分类
    public function getTopCategory()
    {
       // $TopCategories = Category::whereNull('parent_id')->orderBy('sort_order')->get();
        //dump($this->category->getTopCate());
        return $this->category->getTopCate();
    }

    public function getAttribute($category)
    {
        //$category_id = Category::ancestorsAndSelf($category)->pluck('id')->toArray() ;
        $category_id = $this->category->ancestorsAndSelf($category)->pluck('id')->toArray() ;
        $attributes = Attribute::whereIn('category_id', $category_id)->get();
        return $attributes ;  
    }

    public function attributeFilter()
    {
        $filterAttribute = [] ;
        $category = $this->category->find(request()->category);
        $filter = $this->category->getAttributeProduct(request()->category);

        /*$category = request()->category;
        $filter = $category->getAttributeProduct() ;*/
        if($filter)
        {
            $query = request()->query() ? :[];
            foreach($filter as $attribute)
            {
                $key = 'attr'.$attribute->attribute_id ;
                $attribute->querystring = isset($query[$key]) && $query[$key] == urlencode($attribute->attribute_value) ?
                '' : array_merge([$category->id], $query, [$key => urlencode($attribute->attribute_value)]);
                $filterAttribute[$attribute->attribute_id][] = $attribute ;
            }   
        }  
        return $filterAttribute ; 
    }

    


}