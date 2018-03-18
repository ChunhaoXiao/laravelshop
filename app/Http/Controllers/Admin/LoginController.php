<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth ;

class LoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
    	return view('admin.login.login');
    }   

    public function login(Request $request)
    {
    	if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))
    	{
            return redirect()->route('admin.index') ;
    	}	
    	return redirect()->route('admin.showloginform');
    } 

    public function logout()
    {
    	Auth::guard('admin')->logout();
    	return redirect()->route('admin.index');
    }
}
