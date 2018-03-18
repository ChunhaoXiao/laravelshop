<?php 
namespace App\Repositories ;
//use App\Repositories\CategoryRepositoryInterface ;
use App\Models\Category ;
use App\Models\ProductAttribute ;
use App\Models\Attribute ;
use Cache ;
class CategoryRepository implements CategoryRepositoryInterface
{
	private $model ;

    public function __construct(Category $model)
    {   
    	$this->model = $model ;
    }

	public function paginate($num)
	{
		return $this->model->paginate(15) ;
	}

	public function create(array $attribute)
	{
		return $this->model->create($attribute);
	}

	public function update($id, array $attribute)
	{
		return $this->model->find($id)->update($attribute);
	}

	public function delete($id)
	{
		$category = $this->model->findOrFail($id);
	    $category->products()->update(['category_id'=> 0]);
	    $category->delete();
	}

    public function find($id)
	{
		return $this->model->findOrFail($id);
	}

	public function findBy($field, $value, $symbol='=')
	{
		return $this->model->where($field, $symbol, $value)->get();
	}

    //属性筛选
	public function filter($category, $request)
	{
		$query = $this->find($category)->products()->withCount('users');
		if(isset($request['price']))
		{
			$priceRange = explode('-', $request['price']);
			$query = $query->whereBetween('price', $priceRange);
		}

        foreach($request as $k => $v)
        {
        	$attribute_id = ltrim($k, 'attr');
            if(is_numeric($attribute_id))
            {
            	$where = [['attribute_id', $attribute_id], ['attribute_value', urldecode($v)]] ;
            	$query = $query->whereHas('productattributes', function($query) use ($where){
            		return $query->where($where);
            	});
            }    
        }  

        if(isset($request['order']))
        {
            $orderBy = $request['order'];
            if(in_array($orderBy,['price_desc','price_asc']))
            {
                list($field,$type) = explode('_', $orderBy);
                $query = $query->orderBy($field,$type);
            }
            if($orderBy == 'popular')
            {
            	$query = $query->orderBy('users_count','desc');
            }
            //return $query->orderBy('created_at', 'desc');
        }  
        return $query->paginate(10) ;
	}


	public function categoryTree($parent_id = 0)
	{
		if(!$tree = Cache::get('catetree')){
            $categories = $this->model->withCount('attributes')->get()->toArray();
            $tree = $this->getList($categories, $parent_id);
            Cache::forever('catetree', $tree);
        }
        return $tree;
	}

	public function ancestorsAndSelf($category_id)
	{
		return $this->model->ancestorsAndSelf($category_id);
	}

	public function getTopCate($with = 'children')
	{
	    return $this->model->whereNull('parent_id')->with($with)->get();
	}


	public function getAttributeProduct($id)
    {
        $attribute =  $this->find($id)->attributes()->where('attribute_index', 1)->pluck('id')->toArray();
        return Productattribute::whereIn('attribute_id', $attribute)->with('attribute')->groupBy('attribute_value')->get() ;
    }

     public function getAttribute($category)
    {
        $category_ids = $this->model->ancestorsAndSelf($category)->pluck('id')->toArray() ;
        $attributes = Attribute::whereIn('category_id', $category_id)->get();
        return $attributes ;  
    }


	private function getList($data,  $fid = 0,  $deep = 0)
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
	}
    
}