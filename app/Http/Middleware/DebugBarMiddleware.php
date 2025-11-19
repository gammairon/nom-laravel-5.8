<?php
/**
 * User: Artem
 * Date: 22.07.2020
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DebugBarMiddleware
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
        //dump(Auth::check());
        /*if(!Auth::check() || Auth::user()->id !== 1) {
            config(['app.debug' => false]);
            \Debugbar::disable();
        }*/
        return $next($request);
    }
}
