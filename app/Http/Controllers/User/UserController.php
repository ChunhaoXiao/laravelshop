<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserSaveRequest ;
use App\Http\Controllers\Controller;
//use Auth ;
use Illuminate\Support\Facades\Auth;
use Hash ;


class UserController extends Controller
{
	private $user ;

	public function __construct()
	{
        $this->middleware('auth');
		$this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
	}

    public function index()
    {
    	return view('home.user.index');
    }

    public function setting()
    {
    	$user = $this->user ;
    	return view('home.user.setting',['user' => $user]);
    }
    

    public function update(UserSaveRequest $request)
    {

    	$this->user->update(['name' => $request->name]);
    }

    public function changePassword()
    {
    	return view('home.user.changepass');
    }

    public function savePass(UserSaveRequest $request)
    {
    	if(!Hash::check($request->old_password, $this->user->password))
    	{
    		return back()->withError('原密码错误');
    	}
    	$this->user->update(['password' => Hash::make($request->password)]);

    }

    public function footprint()
    {
        $product = $this->user->footprints()->with('product')->orderBy('created_at','desc')->limit(10)->get();
        return view('home.user.footprint', ['products' => $product]);
    } 
}
