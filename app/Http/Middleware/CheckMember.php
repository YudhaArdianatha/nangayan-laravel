<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed

     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
