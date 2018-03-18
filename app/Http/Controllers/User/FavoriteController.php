<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product ;
use App\User ;
use Auth ;

class FavoriteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $favorite = Auth::user()->products()->paginate(10);
        return view('home.user.favorite', ['favoriteProducts' => $favorite]);
    }

    public function addFavorite($product)
    {
    	return Auth::user()->products()->toggle($product);
    }

    /*public function remove($product)
    {
        Auth::user()->products()->detach($product);
        return response()->json(['msg' => '移出成功'], 200);
    }*/
}
