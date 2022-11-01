<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isPlatinum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth("web")->check() || auth()->user()->level != "Platinum") {
            return redirect("/")->with("error", "Bukan Pelanggan Platinum!");
        }
        
        return $next($request);
    }
}
