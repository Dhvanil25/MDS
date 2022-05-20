<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLAlreadyLogin
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
        if(session()->has('LogginId'))
        {
            return redirect('admin/index');
        }
        return $next($request);
    }
}
