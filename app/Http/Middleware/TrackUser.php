<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth ;

class TrackUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user())
        {
           $product =  $request->product ;
           if($row = Auth::user()->footprints()->where('product_id', $product->id)->first())
            {
                $row->update(['updated_at' => time()]);
            }
            else
            {
                Auth::user()->footprints()->create(['product_id'=>$product->id]);
            }
        }
        return $next($request);
    }
}
