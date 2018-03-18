<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Attribute ;
use App\Service\CategoryService ;
use Validator ;
use Image ;

trait ProductTraits{
	public function upload(Request $request)
	{
		if($request->gallery)
		{
			$request->validate($request->gallery,
		    [
			    'gallery' => 'image|mimes:jpeg,png,jpg|max:2048',
		    ]);
			foreach($request->gallery as $file)
			{
			    $name = $file->store("gallery/origin");
                if(!is_dir('gallery/thumb'))
                {
                    Storage::makeDirectory('gallery/thumb');
                }   
                $image = Image::make($file->path());
                $image->resize(200,200);
                $name = pathinfo($name, PATHINFO_BASENAME);
                $image->save("./storage/gallery/thumb/".$name);
                $pic['savepath'] = $name ;
                $pic['showpath'] = asset('storage/gallery/thumb/'.$name);
                $pic['fname'] = pathinfo($name, PATHINFO_FILENAME);
                $data[] = $pic ;
			}
			return response()->json(['data' => $data], 200);
		}
	}

	public function getAttribute(Request $request, CategoryService $CategoryService)
	{
		$attributes = $CategoryService->getAttribute($request->category);
		$element = '' ;
		foreach($attributes as $attribute)
        {
            $element .= "<ul class='list-inline'><li class='col-sm-2'>".$attribute->name."</li>" ;
            if($attribute->getOriginal('input_type') == 1)
            {
                $element.="<li><input  name=attribute[".$attribute->id."][attribute_value] type='text' 
                ></li><li> 价格：</li>
                <li><input name=attribute[".$attribute->id."][attribute_price]></li></ul>";
            }  
            elseif($attribute->getOriginal('input_type') == 2)
            {
                $option = '';
                if($attribute->attribute_value)
                {
                    foreach(explode("\r\n", $attribute->attribute_value) as $item)
                    {
                        $option.="<option value=".$item.">".$item."</option>";
                    }    
                }   
                $element.="<li><select name=attribute[".$attribute->id."][attribute_value][]>".$option."</select></li><li> 
                价格</li><li><input name=attribute[".$attribute->id."][attribute_price][]></li><li>数量</li><li>
                <input name=attribute[".$attribute->id."][attribute_number][]></li><li class='glyphicon glyphicon-plus'></li></ul>";
            } 
        }

		return response()->json(['success' => $element], 200) ;
		/*$category_id = Category::ancestorsAndSelf($request->category)->pluck('id')->toArray() ;
		$attributes = Attribute::whereIn('category_id', $category_id)->get();
	    if($attributes)
	    {   
	    	$html = '' ;
	    	foreach($attributes as $attribute)
	    	{
	    		$html.= $CategoryService->getAttribute($attribute);
	    	}	
	    	return response()->json(['success' => $html], 200) ;
	    }	*/
	}
}