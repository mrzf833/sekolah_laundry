<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role_user = auth()->user()->role;
        if($role_user === 'admin'){
            return $next($request);
        }
        return abort(403,'Maaf Page Ini Cuman Bisa Di Akses Oleh Admin');
    }
}
