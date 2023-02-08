<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

namespace App\Http\Middleware;
 
class useraccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
        
    //     return $next($request);
    // }
    public function handle($request, $next) {
        if (auth()->user())  {
          return $next($request);
        } else{
          return response()->view('erisimyasak');
        }
      }
}
