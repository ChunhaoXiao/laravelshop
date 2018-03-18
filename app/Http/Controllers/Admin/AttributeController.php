<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Category ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    private $category ;
    public function __construct(Request $request)
    {
        $this->middleware('adminauth');
        if($request->category)
        {
            $this->category = Category::findOrFail($request->category);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attributes = $this->category->attributes()->get();
        return view('admin.attribute.index', ['attributes' => $attributes, 'category' => $request->category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = $request->category ;
        return view('admin.attribute.create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
        ]);
        $this->category->attributes()->create($request->all());
        return redirect()->route('attributes.index', ['category' => $request->category]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        return view('admin.attribute.edit')->with('attribute', $attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        return redirect()->route('attributes.index', ['category' => $request->category]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete() ;
        //删除商品的属性
        $attribute->productattributes()->delete();
        return response()->json(['msg' => 'ok'], 200);
    }
}
