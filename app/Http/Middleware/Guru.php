<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Guru
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
        if ($request->user()->role != 'guru' && $request->user()->role != 'wali kelas') {
            return redirect('/admin');
        }
        return $next($request);
    }
}
