<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdminSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->roles->pluck('name')->toArray()[0] != 'admin' && auth()->user()->roles->pluck('name')->toArray()[0] != 'seller') {
            Auth::logout();
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
