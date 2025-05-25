<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized, admin only'], 403);
        }

        return $next($request);
    }
}
