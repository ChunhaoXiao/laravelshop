<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product ;
use App\Models\Cart ;
use App\Service\CartService ;
use App\Http\Requests\SaveCart ;
use Auth;
use Cookie ;

class CartController extends Controller
{
    private $cart ;

    public function __construct(CartService $CartService)
    {
        $this->cart = $CartService ;
    }
    public function index(Request $request)
    {
        $carts = $this->cart->getcart();
        //dump($carts);
       // dump(Cookie::get("carts")['cart4-61-65']);
    	return view('home.cart.index', ['carts' => $carts]);
    }

    public function store(SaveCart $request, CartService $CartService)
    {

    	$product = Product::findOrFail($request->product);
    	if($request->numbers > $product->number)
    	{
    		 return back()->withError(['error' => '数量超过库存量']);
    	}	

    	return  $CartService->addToCart($request, $product);
    }

    public function destroy(Request $request, $cart)
    {
        if(Auth::check())
        {
            Auth::user()->carts()->where('id', $cart)->delete();
            return response()->json(['msg'=>'ok'], 200);
        }
        return response('success')->cookie('carts['.$cart.']', null, -60);
    }
}
