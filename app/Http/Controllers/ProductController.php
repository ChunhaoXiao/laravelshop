<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Category ;
use App\Models\Product ;
use Cookie ;
use App\Repositories\CategoryRepositoryInterface ;
use App\Service\ProductSearchService ;

class ProductController extends Controller
{   
    private $category ;
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category ;
        $this->middleware('trackuser')->only('show');
    }
    public function index(Request $request, $category)
    {
    	$products = $this->category->filter($category, $request->query()) ;
    	return view('home.product.index',['category' => $category, 'products' => $products]);
    }

    public function show(Product $product)
    {
        $commentlist = $product->comments()->with('user')->with(['user.orderproducts'=>function($query) use ($product) 
        {$query->where('product_id', $product->id) ;}])->orderBy('created_at', 'desc')->paginate(20);
        return view('home.product.show', ['product' => $product, 'commentlist'=>$commentlist, 'recommendProducts' => []]);
    }

    public function search(Request $request, ProductSearchService $search)
    {
        $products = $search->filter($request->all())->orderBy('created_at', 'desc')->paginate(15);
        return view('home.product.search', ['products' => $products] );
    }
}
