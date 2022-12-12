<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdmin
{
    public function handle($request, Closure $next)
    {
        $user = $request->auth;
        if (!$user->is_admin){
            return response()->json([
                'error' => 'Not enough rights'
            ], 403);
        }
        return $next($request);
    }
}
