<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        if(auth()->check() && (auth()->user()->status == "Tidak Aktif")){
            Auth::logout();

            return redirect()->route('login')->with('error', 'Akun Anda Sudah Tidak Aktif.');

        }
            return $next($request);
    }
}
