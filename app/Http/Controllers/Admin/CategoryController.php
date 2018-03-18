<?php

namespace App\Http\Controllers\Admin;

//use App\Models\Category;
//use App\Service\CategoryService ;

use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory ;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepositoryInterface ;

class CategoryController extends Controller
{
    private $category ;
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->middleware('adminauth');
        $this->middleware(function($request, $next){
            Cache::forget('catetree') ;
            return $next($request);
        })->only(['store', 'update', 'destroy']);
        $this->category = $category ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = $this->category->categoryTree();
     
        return view('admin.category.index', ['categories' => $categories]);
    }

  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
      
        //Category::create($request->all());
        $this->category->create($request->all()) ;
        return redirect()->route('categories.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    /*public function show(Category $category)
    {   
       // $node = Category::find(8);
       //dump($node->ancestors);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = $this->category->find($category) ;
        return view('admin.category.create',['category' => $category]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $this->category->update($category,$request->all());
        return redirect()->route('categories.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $this->category->delete($category);
        return response()->json(['data' => 'ok'], 200);
    }
}
