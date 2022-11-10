<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (!(auth("web")->check() || auth("caleg")->check())) {
            return redirect("/")->with("error", "Log in first");
        }

        if (auth("web")->check()) return $next($request);
    
        if (auth("caleg")->check()) {
            if (in_array(strtolower(auth("caleg")->user()->level), $levels)) {
                return $next($request);
            }
        }
        abort(403);
    }
}
