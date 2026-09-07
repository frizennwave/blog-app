<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$role): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->hasRole($role)) {
            if ($user->role === 'editor') {
                return redirect()->route('dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            return redirect()->route('home');
        }

        return $next($request);
    }
}
