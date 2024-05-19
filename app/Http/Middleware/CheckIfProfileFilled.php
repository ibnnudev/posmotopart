<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfProfileFilled
{
    public function handle(Request $request, Closure $next): Response
    {
        // check if seller profile is filled
        if (auth()->user()->hasRole('seller') && !auth()->user()->profile_filled) {
            toast('Lengkapi profil anda terlebih dahulu', 'error');
            return redirect()->route('admin.profile.index');
        }
        return $next($request);
    }
}
