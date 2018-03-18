<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ProductTraits ;
use App\Http\Requests\SaveProduct ;
use App\Service\ProductService ;
use App\Service\ProductSearchService ;
use App\Events\ProductUpdated ;
use App\Service\Categoryservice ;
use Storage  ;

class ProductController extends Controller
{
    use ProductTraits ;
    private $ProductService ;
    public function __construct(ProductService $productservice)
    {
        $this->ProductService = $productservice ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductSearchService $search)
    {
        $products = $search->filter($request->query())->with('category')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ProductService->save($request);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Categoryservice $category)
    {

        $attribute = $category->getAttribute($product->category_id);
        $productattribute = array_column($product->productattributes->toArray(), null, 'attribute_id');
        return view('admin.product.edit', ['product' => $product, 'attribute' => $attribute, 'productattribute' => $productattribute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->ProductService->save($request, $product);
        return redirect()->route('products.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->ProductService->delete($product);
        return response()->json(['msg'=>'success'], 200);
    }
}
