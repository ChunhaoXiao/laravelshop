<?php

namespace App\Http\Middleware;

use Closure;

class CheckAddress
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
        if($request->user()->addresses()->count() <1 )
        {
            return redirect()->route('address.create');
        }
        return $next($request);
    }
}
