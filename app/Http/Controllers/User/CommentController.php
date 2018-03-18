<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller ;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest ;
use App\Models\Comment ;
use App\Models\Product ;
use Auth;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function store(CommentRequest $request, Comment $comment)
    {
    	$data = $request->all() ;
    	$this->authorize('create', $comment->make($data));
    	Auth::user()->comments()->create($data);
    	return response()->json(['msg'=>'ok'], 200);
    }
}
